<?php
  $Tip[0] = 'Selecione...';
  foreach ($Tipo as $value) {
      $Tip[$value['id']] = $value['tipo'];
  }

?>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="roles form large-9 medium-8 columns content">
                    
                    <fieldset>
                        <legend><?= __('Adicionar PDF') ?></legend>
                        <?php

                            $x = null;

                            echo $this->Form->create($x,['url'=>['controller'=>'Control','action'=>'add']]);

                            echo $this->Form->input('tipos',['id'=>'tipos','label'=>'Tipo do PDF:','options'=>$Tip]);
                    
                            echo $this->Form->input('textopdf',['id'=>'textopdf','label'=>'Texto PDF:','type'=>'Textarea']);
                        ?>
                    </fieldset>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Html->link(__('Voltar'), ['action' => 'index'], array('class' => 'btn btn-primary')) ?>
                            </div>
                            <div align="right" class="col-md-6" id="botao">
                                <?= $this->Form->button(__('Salvar'), ['align'=>'center','class' => 'form-group']) ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>