							<a>
                                <div class="d-flex align-items-center mb-10" data-toggle="modal" data-target="#newsModal<?= $row['id']; ?>" style="cursor: pointer;">
                                    <div class="symbol symbol-40 mr-5">  
										<span class="svg-icon svg-icon-primary svg-icon-3x">
											<i class="fa fa-gifts" style="color:<?= env('MAIN_COLOR'); ?>"></i>
										</span>
                                    </div>
                                    <div data-toggle="tooltip" data-placement="top" title="Geöffnet: <?= $helper->formatDate($row['opened_at']); ?>">
                                        <span class="text-dark news-hover">Törchen: <?= $streak['tor']; ?></span>
										<br>
										<small>
                            <?php
                            $SQL = $db->prepare("SELECT * FROM `adventskalender` WHERE `id` = :openid");
                            $SQL->execute(array(":openid" => $streak['tor']));
                            if ($SQL->rowCount() != 0) {
                            while ($rowad = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>

							<?= $rowad['win']; ?>
							
                            <?php } } ?>
										</small>
                                    </div>
                                </div>
							</a>
