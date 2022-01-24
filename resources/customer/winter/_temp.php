                            <?php
                            $SQL8 = $db->prepare("SELECT * FROM `adventskalender` WHERE `id` = :lid AND `closed_at` < :datenow");
                            $SQL8->execute(array(":lid" => $row['id'], ":datenow" => $dateTimeNow));
                            if ($SQL8->rowCount() != 0) {
                            while ($row8 = $SQL8 -> fetch(PDO::FETCH_ASSOC)){ ?>
							
                            <?php } } ?>

                            <?php
                            $SQL2 = $db->prepare("SELECT * FROM `adventskalender_used` WHERE `userid` = :userid AND `tor` = :tid");
                            $SQL2->execute(array(":userid" => $userid, ":tid" => $row['id']));
                            if ($SQL2->rowCount() != 0) {
                            while ($rows = $SQL2 -> fetch(PDO::FETCH_ASSOC)){ ?>
							
                            <?php } } ?>

			 <?php if($SQL2->rowCount() == 0){ ?>


			 <?php if($SQL8->rowCount() == 0){ ?>

							<a href="adventskalender/open/<?= $row['id']; ?>">
                                <div class="d-flex align-items-center mb-10" data-toggle="modal" data-target="#newsModal<?= $row['id']; ?>" style="cursor: pointer;">
                                    <div class="symbol symbol-40 mr-5">  
										<span class="svg-icon svg-icon-primary svg-icon-3x">
											<i class="fa fa-door-closed" style="color:<?= env('MAIN_COLOR'); ?>"></i>
										</span>
                                    </div>
                                    <div data-toggle="tooltip" data-placement="top" title="Törchen öffnen">
                                        <span class="text-dark news-hover">Törchen <?= $row['id']; ?></span>
                                    </div>
                                </div>
							</a>

                    <?php } ?>
		  

                    <?php } ?>

			 <?php if($SQL2->rowCount() !== 0){ ?>



			 <?php if($SQL8->rowCount() == 0){ ?>

							<a>
                                <div class="d-flex align-items-center mb-10" data-toggle="modal" data-target="#newsModal<?= $row['id']; ?>" style="cursor: pointer;">
                                    <div class="symbol symbol-40 mr-5">  
										<span class="svg-icon svg-icon-primary svg-icon-3x">
											<i class="fa fa-door-open" style="color:<?= env('MAIN_COLOR'); ?>"></i>
										</span>
                                    </div>
                                    <div data-toggle="tooltip" data-placement="top" title="Törchen bereits geöffnet">
                                        <span class="text-dark news-hover">[GEÖFFNET] Törchen <?= $row['id']; ?></span>
                                    </div>
                                </div>
							</a>
		  

                    <?php } ?>
		  

                    <?php } ?>

			 <?php if($SQL8->rowCount() !== 0){ ?>

							<a>
                                <div class="d-flex align-items-center mb-10" data-toggle="modal" data-target="#newsModal<?= $row['id']; ?>" style="cursor: pointer;">
                                    <div class="symbol symbol-40 mr-5">  
										<span class="svg-icon svg-icon-primary svg-icon-3x">
											<i class="fa fa-times" style="color:<?= env('MAIN_COLOR'); ?>"></i>
										</span>
                                    </div>
                                    <div data-toggle="tooltip" data-placement="top" title="Törchen bereits geöffnet">
                                        <span class="text-dark news-hover">[VORBEI] Törchen <?= $row['id']; ?></span>
                                    </div>
                                </div>
							</a>

                    <?php } ?>
