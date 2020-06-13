<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tienda de Camisetas</title>
        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"/>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?=base_url?>assets/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="<?=base_url?>assets/js/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="<?=base_url?>assets/js/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="<?=base_url?>assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <!--CABECERA-->
            <header class="container-fluid bg-secondary" id="header">
                <div class="row m-0" id="logo">
                    <div class="col-12 col-lg-2 text-center">
                        <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo"/>
                    </div>
                    <div class="col-12 col-lg-10 px-0 pt-4 text-center text-lg-left">
                        <a href="<?=base_url?>">
                            Tienda de camisetas
                        </a>
                    </div>
                </div>
            </header>
            <!--MENU-->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav class="container-fluid" id="menu">
                <ul class="row">
                    <li class="col-12 col-md-4 col-lg-1 text-center">
                        <a href="<?=base_url?>">Inicio</a>
                    </li>
                    <?php 
                    $i = 0;
                    while($cat = $categorias->fetch_object()):
                        $i++;
                        if($i < 5 ):
                    ?>
                    <li class="col-12 col-md-4 col-lg-2 text-center">
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                    </li>
                    <?php elseif($i == 5):?>
                    <li class="col-12 col-md-4 col-lg-3 text-center">
                           
                            <div class="dropdown">
                                
                                <button type="button" class="btn text-white dropdown-toggle" data-toggle="dropdown">
                                Mas categorias
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                        <?php else:?>
                                <a class="dropdown-item" href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                        <?php 
                            endif;
                        endwhile;?>
                                </div>
                            </div>
                        
                    </li>
                </ul>
            </nav>
            <div id="content">