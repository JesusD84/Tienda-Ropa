<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'):?>
<h1>Tu pedido se ha confirmado</h1>
<p>
    Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria
    a la cuenta 457645364AGRH con el
    coste del pedido, sera procesado y enviado
</p>
<br>
<?php if(isset($pedido)):?>
<h3>Datos del pedido:</h3>
<br>
Número de pedido: <?=$pedido->id?>
<br>
Total a pagar: <?=$pedido->coste?>$
<br>
Productos: 
<?php while($producto = $productos->fetch_object()):?>
<ul>
    <li><?=$producto->nombre?>   -   <?=$producto->precio?>$   -   x<?=$producto->unidades?></li>
</ul>
<?php endwhile;?>
<?php endif;?>

<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'confirm'):?>
<h1>Tu pedido NO ha podido procesarse</h1>
<?php endif;?>