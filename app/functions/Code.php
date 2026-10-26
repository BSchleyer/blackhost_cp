<?php

$voucher_code = new Code();
class Code extends Controller
{

    public function getCode($code) {
        $SQL = self::db()->prepare("SELECT * FROM `codes` WHERE `code` = :code");
        $SQL->execute(array(":code" => $code));
        if($SQL->rowCount() == 1) {
            return $SQL->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function getUsed($code, $user_id)
    {
        $SQL = self::db()->prepare("SELECT * FROM `code_used` WHERE `code` = :code AND `user_id` = :user_id");
        $SQL->execute(array(":code" => $code, ":user_id" => $user_id));

        return $SQL->rowCount();
    }

    public function codeUsage($code) {
        $code = self::getCode($code);

        if($code['useable'] != 0){
            return true;
        }

        return false;
    }

    public function useCode($code, $user_id) {
        $db = self::db();

        try {
            $db->beginTransaction();

            // lock the code row so concurrent redemptions are serialized
            $SQL = $db->prepare("SELECT * FROM `codes` WHERE `code` = :code FOR UPDATE");
            $SQL->execute(array(":code" => $code));
            $data = $SQL->fetch(PDO::FETCH_ASSOC);

            if(!$data || $data['useable'] <= 0){
                $db->rollBack();
                return false;
            }

            $SQL = $db->prepare("SELECT COUNT(*) FROM `code_used` WHERE `code` = :code AND `user_id` = :user_id");
            $SQL->execute(array(":code" => $code, ":user_id" => $user_id));
            if($SQL->fetchColumn() > 0){
                $db->rollBack();
                return false;
            }

            $SQL = $db->prepare("UPDATE `users` SET `amount` = `amount` + :amount WHERE `id` = :user_id");
            $SQL->execute(array(":amount" => $data['amount'], ":user_id" => $user_id));

            $SQL = $db->prepare("INSERT INTO `user_transactions`(`user_id`, `amount`, `desc`) VALUES (?,?,?)");
            $SQL->execute(array($user_id, $data['amount'], 'Gutschein eingelöst'));

            $SQL = $db->prepare("INSERT INTO `code_used` (`code`, `user_id`) VALUES (:code, :user_id)");
            $SQL->execute(array(":code" => $code, ":user_id" => $user_id));

            $SQL = $db->prepare("UPDATE `codes` SET `useable` = `useable` - 1 WHERE `code` = :code");
            $SQL->execute(array(":code" => $code));

            $db->commit();
            return true;
        } catch (Exception $e) {
            if($db->inTransaction()){
                $db->rollBack();
            }
            return false;
        }
    }

}