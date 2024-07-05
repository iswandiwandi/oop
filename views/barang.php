<?php
require_once "models/m_barang.php";
$brg = new Barang($conn);


if (@$_GET['act'] == '') {





?>
  <link rel="stylesheet" href="assets/bootstrap-5/dist/css/bootstrap.min.css">

  <div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Barang</h1>
    <!--11.  -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <!--12.Buat Database nya db_latihan.sql -->
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Stock Barang</th>
                <th>Gambar Barang</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $tampil = $brg->tampil();

              while ($isi = $tampil->fetch_object()) :
              ?>
                <tr class="text-center">
                  <td><?= $no++ ?></td>
                  <td><?= $isi->nama_brg ?></td>
                  <td><?= $isi->harga_brg ?></td>
                  <td><?= $isi->stock_brg ?></td>
                  <td><img src="assets/img/barang/<?= $isi->gbr_brg ?>" width="80" alt=""></td>
                  <td>
                    <a id="edit_brg" data-toggle="modal" data-target="#edit" data-idedt="<?= $isi->id_brg ?>" data-nama="<?= $isi->nama_brg ?>" data-harga="<?= $isi->harga_brg ?>" data-stc="<?= $isi->stock_brg ?>" data-gbr="<?= $isi->gbr_brg ?>">
                      <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button></a>
                    <a href="?page=barang&act=del&id=<?= base64_encode($isi->id_brg) ?>" onclick="return confirm('Apakah ingin menghapus data ini ?')">
                      <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button></a>
                  </td>
                </tr>
              <?php endwhile; ?>

            </tbody>
          </table>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa plus"></i> Tambah data </button>
      </div>

      <!-- Modal Tambah -->
      <div id="cetakpdf" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Cetak PDF</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formedit" enctype="multipart/form-data">
              <div class="modal-body">
                <form action="reports/reportPDF.php" methode="POST" target="_blank">
                  <tr>
                    <td>

                      <div class="form group">Dari Tanggal</div>
                    </td>
                    <td>
                      <label for="nm_brg" class="form-label"> Nama Barang</label>
                      <input type="text" name="nm_brg" class="form-control" id="nm_brg" required>
              </div>
              <div class="form group">
                <label for="hrg_brg" class="form label"> Harga Barang</label>
                <input type="number" name="hrg_brg" class="form-control" id="hrg_brg" required>
              </div>
              <div class="form group">
                <label for="stc_brg" class="form-label">Stock Barang</label>
                <input type="text" name="stc_brg" class="form-control" id="stc_brg" required>
              </div>
              <div class="form group">
                <label for="gbr_brg" class="form-label"> Gambar Barang</label>
                <input type="file" name="gbr_brg" class="form-control" id="gbr_brg" accept=".png, .jpg,.jpeg,.gif,.svg,.webp">
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn - primary" name="tambah">Tambah</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!--modal edit-->
    <div id="edit" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"> Edit Data Barang</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form id="formedit" enctype="multipart/form-data">
            <div class="modal-body" id="modalbody_">
              <div class="form group">
                <input type="text" id="idedit" name="idedit">
                <label for="nm_brg" class="form-label"> Nama Barang</label>
                <input type="text" name="nm_brg" class="form-control" id="nm_brg" required>
              </div>
              <div class="form group">
                <label for="hrg_brg" class="form label"> Harga Barang</label>
                <input type="number" name="hrg_brg" class="form-control" id="hrg_brg" required>
              </div>
              <div class="form group">
                <label for="stc_brg" class="form-label">Stock Barang</label>
                <input type="text" name="stc_brg" class="form-control" id="stc_brg" required>
              </div>
              <div class="form group">
                <label for="gbr_brg" class="form-label"> Gambar Barang</label>
                <div class="my-2">
                  <img src="" alt="" width="80" id="pict">

                  <input type="file" name="gbr_brg" class="form-control" id="gbr_brg" accept=".png, .jpg,.jpeg,.gif,.svg,.webp">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="edit">Edit</button>
              </div>


          </form>
        </div>
      </div>
    </div>
    <script src="assets/vendor/jquery/jquery.minjs " type=" type/javascript"></script>
    <script>
      $(document).on("click", "#edit_brg", function() {
        var idbrg = $(this).data('idedit');
        var nama = $(this).data('nama');
        var hrgbrg = $(this).data('harga');
        var stcbrg = $(this).data('stc');
        var gbrbrg = $(this).data('gbr');

        $("#modalBody_ #idedit").val(idbrg);
        $("#modalBody_ #nm_brg").val(nama);
        $("#modalBody_ #hrg_brg").val(hrgbrg);
        $("#modalBody_ #stc_brg").val(stcbrg);
        $("#modalBody_ #pict").attr("src", "assets/img/barang/" + gbrbrg);
      })
      // process :
      $(document).ready(function(e) {
        $("#formedit").on("submit", (function(e) {
          e.preventDefault();
          $.ajax({
            url: 'models/prcs_barang.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(msg) {
              $('.table').html(msg);
            }
          })

        }))
      })
    </script>
  </div>
  </div>
  </div>
<?php
} else if (@$_GET['act'] == 'del') {
  $iddecode = base64_decode($_GET['id']);
  echo "id nya :" . $iddecode;
  $gbr_awal = $brg->tampil($iddecode)->fetch_object()->gbr_brg;

  unlink("assets/img/barang/" . $gbr_awal);
  $brg->hapus($iddecode);

  echo "<script>window.location = '? page-barang';</script>";
  exit();
}
?>