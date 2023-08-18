<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <div class="roles form large-9 medium-8 columns content">

                <div align='right'>
                    <?= $this->Html->link(__('<i>Adicionar PDF</i>'), 
                        array('action'=>'add'), 
                        array('class'=>'btn btn-success btn-xs',
                        'escape' => false)); 
                    ?>
                </div>

                <legend><?= __('Listar PDF:') ?></legend>

                <div class="box-body" align="center">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td><b>Id</b></td>
                                <td><b>Texto</b></td>
                                <td><b>Tipo</b></td>
                                <td><b>Ações</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Documento as $value):?>
                            <tr>
                                <td><?= $value['TEXTOID'] ?></td>
                                <td><?= $value['TEXTO'] ?></td>
                                <td><?= $value['TIPO'] ?></td>
                                <td>
                                    <?= $this->Html->link(__('<i class="glyphicon glyphicon-file"></i>'), 
                                        array('controller'=>'Control','action'=>'gerarpdf',$value['TEXTOID']), array('class'=>
                                        'btn btn-primary btn-xs','escape'=>false,'data-toggle'=>'tooltip',
                                        'title'=>'Gerar PDF'));
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"></link>

<?php
    $this->Html->script(['AdminLTE./plugins/fileSaver/FileSaver.js',], ['block' => 'script']);
    $this->Html->script(['AdminLTE./plugins/canvasToBlob/canvas-toBlob.js',], ['block' => 'script']);
    $this->Html->script(['AdminLTE./plugins/Chart.js-2.3.0/dist/Chart.js',], ['block' => 'script']);
    $this->Html->script(['//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js',], ['block' => 'script']);
?>

<script>
    $(document).ready(function(){
        $('#example2').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(Filtrado de _MAX_ total registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior"
                }
            },"lengthMenu": [ 7, 10, 15 ]
        });
    });
</script>