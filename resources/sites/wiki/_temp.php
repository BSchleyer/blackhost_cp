							<a href="wiki/read/<?= $row['id']; ?>">
                                <div class="d-flex align-items-center mb-10" data-toggle="modal" data-target="#newsModal<?= $row['id']; ?>" style="cursor: pointer;">
                                    <div class="symbol symbol-40 mr-5">  
										<span class="svg-icon svg-icon-primary svg-icon-3x">
											<i class="<?= $row['icon']; ?>" style="color:<?= env('MAIN_COLOR'); ?>"></i>
										</span>
                                    </div>
                                    <div data-toggle="tooltip" data-placement="top" title="Beitrag lesen">
                                        <span class="text-dark news-hover"><?= $row['title']; ?></span>
										<br>
										<small class="text-muted">Erstellt: <?= $helper->formatDate($row['created_at']); ?></small>
                                    </div>
                                </div>
							</a>