<?php
include 'auth.php';
include  'korisnikData.php';
$korisnik = getKorisnikById($con,$_GET['id']);
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php'; ?>
    <form action="updateUser.php" method="post">
        <div class="cont">
            <h1>Ažuriranje korisnika</h1>
            <hr>
            <label for="name"><b>Ime</b></label>
            <input type="text" placeholder="Unesite ime" name="name" value="<?php echo $korisnik['ime'];?>" required>
            <label for="lastname"><b>Prezime</b></label>
            <input type="text" placeholder="Unesite prezime" name="lastname" value="<?php echo $korisnik['prezime'];?>" required>
            <label for="username"><b>Korisničko ime</b></label>
            <input type="text" placeholder="Unesite korisničko ime" name="username" value="<?php echo $korisnik['korisnicko_ime'];?>" required>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Unesite email" name="email" value="<?php echo $korisnik['email'];?>" required>
            <label for="lozinka"><b>Loznika</b></label>
            <input type="password" placeholder="Loznika" name="lozinka" value="<?php echo $korisnik['lozinka'] ?>" required>
            <label for="ponovljena_lozinka"><b>Ponovljena lozinka</b></label>
            <input type="password" placeholder="Ponovljena lozinka" name="ponovljena_lozinka" required>
            <input type="hidden" name="id" value="<?php echo $korisnik['korisnik_id'];?>">
            <label for="img"><b>Slika (URL)</b></label>
            <input type="text" placeholder="Unesite url od slike" name="img" value="<?php echo $korisnik['slika'];?>" required>
            <input type="checkbox" value="1" name="tip" <?php  if($korisnik['tip_id'] == 1){
                echo 'checked';
            } ?>>
            <label for="tip"><b>Postavi za moderatora</b></label>
            <input type="submit" class="btn" value="Spremi">
        </div>
    </form>
</div>
</body>
</html>

