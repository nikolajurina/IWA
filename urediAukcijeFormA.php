<form action="updateAukcije.php" method="post">
    <div class="container">
        <h1>Ažuriraj vrijeme završetka</h1>
        <hr>
        <?php showVoditeljeU($con,$aukc[0]['moderator_id']); ?>
        <label for="naziv"><b>Naziv</b></label>
        <input type="text" placeholder="Naziv" name="naziv" value="<?php echo $aukc[0]['naziv']; ?>" required>
        <label for="opis"><b>Opis</b></label>
        <input type="text" placeholder="Opis" name="opis" value="<?php echo $aukc[0]['naziv']; ?>" required>
        <label for="datump"><b>Datum početka</b></label>
        <input type="text" placeholder="dd.mm.gggg" name="datump" value="<?php echo  dateOnlyToHrFormat($aukc[0]['datum_vrijeme_pocetka']); ?>" required>
        <label for="vrijemep"><b>Vrijeme početka</b></label>
        <input type="text" placeholder="hh:mm:ss" name="vrijemep" value="<?php echo timeOnlyToHrFormat($aukc[0]['datum_vrijeme_pocetka']); ?>" required>
        <label for="datum"><b>Datum završetka</b></label>
        <input type="text" placeholder="dd.mm.gggg" name="datum" value="<?php echo  dateOnlyToHrFormat($aukc[0]['datum_vrijeme_zavrsetka']); ?>" required>
        <label for="vrijeme"><b>Vrijeme završetka</b></label>
        <input type="text" placeholder="hh:mm:ss" name="vrijeme" value="<?php echo timeOnlyToHrFormat($aukc[0]['datum_vrijeme_zavrsetka']); ?>" required>
        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
        <input type="submit" value="Postavi" class="btnLogin">
    </div>


</form>
