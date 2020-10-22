<?php
//koneksi ke database mysql,
$koneksi = mysqli_connect("localhost","root","","matakuliah");

//cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
if (mysqli_connect_errno()){
	echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}

function registrasi($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah terdaftar')
              </script>";
        return false;
    }

    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($koneksi);

}
?>

