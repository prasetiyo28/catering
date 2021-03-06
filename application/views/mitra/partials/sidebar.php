<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Mitra</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>mitra">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    


    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>Mitra/datapaket">
        <i class="fas fa-fw fa-table"></i>
        <span>Paket Catering</span>
      </a>
    </li>
    <li class="nav-item">
      <?php if ($this->session->userdata('id_mitra') == '') { ?>
        <a class="nav-link" href="#" data-toggle="modal" data-target="#please">

        <?php }else{ ?>
          <a  class="nav-link" href="<?php echo base_url() ?>mitra/pesananmasuk">
          <?php } ?>
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Pesanan Masuk</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->


      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>Mitra/histori">
          <i class="fas fa-fw fa-history"></i>
          <span>Histori</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <!-- Modal -->
    <div class="modal fade" id="please" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <p>Silahkan lengkapi data catering di halaman <a href="<?php echo base_url() ?>/mitra">dashboard</a>.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>