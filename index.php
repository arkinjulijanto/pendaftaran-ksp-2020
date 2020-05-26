<!DOCTYPE html>
<html lang="EN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pendaftaran KSP Genap 2019/2020</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/brands.css" integrity="sha384-BCEeiNUiLzxxoeYaIu7jJqq0aVVz2O2Ig4WbWEmRQ2Dx/AAxNV1wMDBXyyrxw1Zd" crossorigin="anonymous">
    </head>
    <body style="background-image: url(1.png);">
        <?php
            include "koneksi.php";
            if(isset($_POST['daftar'])){
                $daftar = mysqli_query($conn, "INSERT INTO tb_pendaftaran VALUES
                ('".$_POST['id']."',
                '".$_POST['nama']."',
                '".$_POST['npm']."',
                '".$_POST['kelamin']."',
                '".$_POST['id_line']."',
                '".$_POST['hari']."',
                '".$_POST['motivasi']."')");
                if(isset($_POST['daftar']) && $daftar){
                    echo '<script>alert("Berhasil daftar")</script>';
                }
            }
        ?>
        <div class="box-form">
            <h2 style="text-align: center;">Pendaftaran KSP<br>Semester Genap 2019-2020</h2>
            <div class="kuota">
                Sisa Kuota : 
                <strong>
                    <?php
                        $kuota = mysqli_query($conn, "SELECT MAX(nomor) AS akhir FROM tb_pendaftaran");
                        $kuota_akhir = mysqli_fetch_array($kuota);
                        $kuta = (int) $kuota_akhir['akhir'];
                        $kuota1 = 24 - $kuta;
                        echo $kuota1;

                        $k_senin = mysqli_query($conn, "SELECT * FROM tb_pendaftaran WHERE hari='Senin'");
                        $senin1 = mysqli_num_rows($k_senin);
                        $senin = 9 - $senin1;
                        
                        $k_selasa = mysqli_query($conn, "SELECT * FROM tb_pendaftaran WHERE hari='Selasa'");
                        $selasa1 = mysqli_num_rows($k_selasa);
                        $selasa = 15 - $selasa1;
                        
                    ?>
                </strong><br>
                <table>
                    <tr>
                        <th>Kuota Senin</th>
                        <th>Kuota Selasa</th>
                    </tr>
                    <tr>
                        <td><?php echo $senin ?></td>
                        <td><?php echo $selasa ?></td>
                    </tr>
                </table>
            </div>
            <script type="text/javascript">
                var mon1 = "<?php echo $senin ?>";
                var tue1 = "<?php echo $selasa ?>";
                var quo1 = "<?php echo $kuota1 ?>";
                var mon = parseInt(mon1);
                var tue = parseInt(tue1);
                var quo = parseInt(quo1);

                window.onload = function() {
                        if(quo == 0){
                            document.getElementById("btnSubmit").disabled = true;
                        }

                        if(mon == 0){
                            document.getElementById("har").options[0].disabled = true;
                            document.getElementById("har").selectedIndex = 1;
                        }

                        if(tue == 0){
                            document.getElementById("har").options[1].disabled = true;
                            document.getElementById("har").selectedIndex = 0;
                        }
                }

            </script>
            <form action="" method="POST">
                <?php
                    $data = mysqli_query($conn, "SELECT MAX(nomor) AS id FROM tb_pendaftaran");
                    $data_akhir = mysqli_fetch_array($data);
                    $id1 = $data_akhir['id'];
                    $id2 = $id1 + 1;
                ?>
                <input type="hidden" name="id" value="
                <?php 
                    echo $id2
                ?>
                " /><br>
                <div class="inputan">
                    Nama Lengkap : <span style="color:#991D57;">*</span><br>
                    <input type="text" name="nama" class="control" required/><br>

                    NPM: <span style="color:#991D57;">*</span><br>
                    <input type="text" name="npm" class="control" required pattern="[0-9]{9}"/><br>

                    Jenis Kelamin: <span style="color:#991D57;;">*</span><br>
                    <select name="kelamin" class="control">
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>

                    <br>ID LINE: <span style="color:#991D57;;">*</span><br>
                    <input type="text" name="id_line" class="control" required /><br>

                    Pilihan Hari: <span style="color:#991D57;;">*</span><br>
                    <select name="hari" id="har" class="control">
                        <option value="Senin">Senin, sesi 5</option>
                        <option value="Selasa">Selasa, sesi 5</option>
                    </select>

                    <br>Motivasi: <span style="color:#991D57;;">*</span><br>
                    <textarea name="motivasi" rows="4" class="control" required></textarea><br>

                    <button id="btnSubmit" type="submit" name="daftar" value="daftar">Daftar</button><br>
                </div>
            </form>

            <!-- penutup -->
            <!-- <div style="text-align:center;">
                <br>
                <h2>Pendaftaran sudah ditutup</h2>
                <br>
                Untuk informasi lebih lanjut, silahkan hubungi OA KSP. Terimakasih.
            </div> -->

        </div>
        <script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.locatoin.href);
            }
        </script>
    </body>
</html>    