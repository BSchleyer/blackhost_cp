                                                <?php if($check == "unknow"){ ?>
                                                <button class="btn btn-outline-primary btn-sm font-weight-bolder"disabled>Unbekannt</button>
                                                <?php } ?>

                                                <?php if($check == "frei"){ ?>
                                                <button type="submit" name="orderDomain" class="btn btn-outline-success btn-sm font-weight-bolder">Kostenpflichtig bestellen*</button>
                                                <?php } ?>

                                                <?php if($check == "vergeben"){ ?>
                                                <button class="btn btn-outline-warning btn-sm font-weight-bolder" disabled>Nicht Verfügbar</button>
                                                <?php } ?>