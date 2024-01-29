<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url('menu/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah menu</a>
                </div>
            </div>
            <div class="box-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <?php $this->db->order_by('urutan', 'asc'); $menu = $this->db->get_where('menu', ['submenu' => 0])->result_array(); ?>
                            <div class="dd" id="nestable3">
                                <ol class="dd-list">   
                                    <?php foreach($menu as $row) : ?>
                                        <li class="dd-item dd3-item" data-id="<?= $row['id_menu'] ?>" data-nama="<?php echo $row['nama_menu'] ?>" data-urutan="<?php echo $row['urutan'] ?>">
                                            <div class="dd-handle bg-primary dd3-handle"></div>
                                            <div class="dd3-content noselect">
                                                <div class="pull-left">
                                                    <i class="<?= $row['icon'] ?>"></i> <?= $row['nama_menu'] ?>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="<?php echo base_url('menu/edit/') . $row['id_menu'] ?>" class="btn btn-warning d-inline"><i class="fa fa-edit"></i></a>
                                                    <a data-id="<?php echo $row['id_menu'] ?>" data-href="<?php echo base_url('menu/hapus/') . $row['id_menu'] ?>" class="btn btn-danger d-inline hapus-menu"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                            <ol class="dd-list">
                                                <?php $this->db->order_by('urutan', 'asc'); $submenu = $this->db->get_where('menu',['submenu' => $row['id_menu']])->result_array(); ?>
                                                <?php foreach($submenu as $row) : ?>
                                                    <li class="dd-item dd3-item" data-id="<?= $row['id_menu'] ?>" data-nama="<?php echo $row['nama_menu'] ?>" data-urutan="<?php echo $row['urutan'] ?>"  data-menu-utama="<?php echo $row['submenu'] ?>">
                                                        <div class="dd-handle bg-primary dd3-handle"></div>
                                                        <div class="dd3-content noselect">
                                                            <div class="pull-left">
                                                                <i class="<?= $row['icon'] ?>"></i> <?= $row['nama_menu'] ?>
                                                            </div>
                                                            <div class="pull-right">
                                                                <a href="<?php echo base_url('menu/edit/') . $row['id_menu'] ?>" class="btn btn-warning d-inline"><i class="fa fa-edit"></i></a>
                                                                <a data-id="<?php echo $row['id_menu'] ?>" data-href="<?php echo base_url('menu/hapus/') . $row['id_menu'] ?>" class="btn btn-danger d-inline hapus-menu"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ol>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
