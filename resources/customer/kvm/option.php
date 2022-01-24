<option <?php if($row['disabled'] == "1"){echo 'disabled';} ?>
												data-price="<?= $row['price']; ?>" 
												value="<?= $row['value']; ?>">
										 <?= $row['name']; ?> (+ <?= $row['price']; ?>€) 
										 <?php if($row['disabled'] == "1"){echo '- Zurzeit nicht verfügbar';} ?>
									</option>