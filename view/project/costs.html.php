<?php 

use Goteo\Library\Text;

$bodyClass = 'project-form';

include 'view/prologue.html.php';
    
    include 'view/header.html.php'; ?>

        <div id="sub-header">
            <div>
                <h2>Formulario</h2>
            </div>
        </div>

        <div id="main" class="costs">

            <form method="post" action="">

                <?php include 'view/project/status.html.php' ?>
                <?php include 'view/project/steps.html.php' ?>

                <div class="form">

                    <h3>Proyecto/Costes</h3>

                    <?php include 'view/project/guide.html.php' ?>

                    <ol class="fields">

                        <li class="costs"><h4>Desglose de costes</h4>
                            <ol id="project-form-costs"></ol>
                            
                            <div class="addcost">
                                
                                <h6>Nuevo coste</h6>
                                
                                <div class="type">
                                    Tipo:
                                    <label><input type="radio" name="type" value="task" checked="checked" />
                                    Tarea</label>
                                    <label><input type="radio" name="type" value="infrastructure" />
                                    Infraestructura</label>
                                </div>
                                
                                <div class="description">                                    
                                    <label>Descripción</label>                                    
                                </div>
                                
                                <div class=""
                                
                            </div>
                            
                            <input name="addcost" type="submit" value="Añadir nuevo coste">
                        </li>

                        <li class="others"><h4>¿Cuenta con otros recursos?</h4>
                            <h5>Otras ayudas económicas o infraestructuras</h5>                        
                            <textarea></textarea>                        
                        </li>

                        <li class="schedule">
                            <h4>Agenda</h4>
                            <h5>Tiempo de producción del proyecto</h5>                                            
                        </li>

                    </ol>

                    <div class="buttons">
                        <input type="submit" value="Continuar" />
                    </div>

                </div>

                <?php include 'view/project/steps.html.php' ?>

            </form>

        </div>
                
    <?php include 'view/footer.html.php' ?>
    
<?php include 'view/epilogue.html.php' ?>

<!--
PROYECTO / Costes<br />
GUÍA: <?php echo $guideText; ?><br />
<?php include 'view/project/errors.html.php' ?>
<hr />
<form action="/project/costs" method="post">
	<fieldset>
		<legend>Nuevo coste</legend>
		<dl>
			<dt><label for="ncost">Coste</label></dt>
			<dd><input type="text" id="ncost" name="ncost" value=""/></dd>

			<dt><label for="ncost-description">Descripción</label></dt>
			<dd><textarea id="ncost-description" name="ncost-description" cols="20" rows="3"></textarea></dd>

			<dt><label for="ncost-amount">Costes</label></dt>
			<dd><input type="text" id="ncost-amount" name="ncost-amount" value="" /></dd>

			<dt><label for="ncost-type">Tipo</label></dt>
			<dd><select id="ncost-type" name="ncost-type">
					<?php foreach ($types as $Id => $Val) : ?>
						<option value="<?php echo $Id; ?>"><?php echo $Val; ?></option>
					<?php endforeach; ?>
					</select>
			</dd>

			<dt><label for="ncost-required">Imprescindible</label></dt>
			<dd><input type="checkbox" id="ncost-required" name="ncost-required" value="1" /></dd>

			<dt><label for="ncost-from">Desde</label></dt>
			<dd><input type="text" id="ncost-from" name="ncost-from" value="<?php echo date('Y-m-d'); ?>" /></dd>

			<dt><label for="ncost-until">Hasta</label></dt>
			<dd><input type="text" id="ncost-until" name="ncost-until" value="<?php echo date('Y-m-d'); ?>" /></dd>

		</dl>

		<input type="button" id="new-cost" value="Nuevo coste" />

        <?php if (!$project->itsok('ncost')) echo $project->errors['ncost']; ?>
		<span><?php echo Text::get('tooltip project ncost'); ?></span><br />
	</fieldset>

	<?php foreach ($project->costs as $cost) : ?>
			<fieldset>
				<legend>Coste <?php echo $cost->id; ?></legend>
				<label>REMOVE! <input type="checkbox" name="remove-cost<?php echo $cost->id; ?>" value="1" /></label>
				<dl>
					<dt><label for="cost<?php echo $cost->id; ?>">Coste</label></dt>
					<dd><input type="text" id="cost<?php echo $cost->id; ?>" name="cost<?php echo $cost->id; ?>" value="<?php echo $cost->cost; ?>"/></dd>
                    <?php if ($project->itsok('cost'.$cost->id)) echo 'OK'; else echo $project->errors['cost'.$cost->id]; ?>

					<dt><label for="cost-description<?php echo $cost->id; ?>">Descripción</label></dt>
					<dd><textarea id="cost-description<?php echo $cost->id; ?>" name="cost-description<?php echo $cost->id; ?>" cols="20" rows="3"><?php echo $cost->description; ?></textarea></dd>
                    <?php if ($project->itsok('cost-description'.$cost->id)) echo 'OK'; else echo $project->errors['cost-description'.$cost->id]; ?>

					<dt><label for="cost-type<?php echo $cost->id; ?>">Tipo</label></dt>
					<dd><select id="cost-type<?php echo $cost->id; ?>" name="cost-type<?php echo $cost->id; ?>">
						<?php foreach ($types as $Id => $Val) : ?>
							<option value="<?php echo $Id; ?>"<?php if ($cost->type == $Id) echo ' selected="selected"'; ?>><?php echo $Val; ?></option>
						<?php endforeach; ?>
						</select>
					</dd>

				<dt><label for="cost-amount<?php echo $cost->id; ?>">Costes</label></dt>
				<dd><input type="text" id="cost-amount<?php echo $cost->id; ?>" name="cost-amount<?php echo $cost->id; ?>" value="<?php echo $cost->amount; ?>" /></dd>

				<dt><label for="cost-required<?php echo $cost->id; ?>">Imprescindible</label></dt>
				<dd><input type="checkbox" id="cost-required<?php echo $cost->id; ?>" name="cost-required<?php echo $cost->id; ?>" value="1" <?php if ($cost->required) echo 'checked="checked"'; ?>/></dd>

				<dt><label for="cost-from<?php echo $cost->id; ?>">Desde</label></dt>
				<dd><input type="text" id="cost-from<?php echo $cost->id; ?>" name="cost-from<?php echo $cost->id; ?>" value="<?php echo $cost->from; ?>" /></dd>

				<dt><label for="cost-until<?php echo $cost->id; ?>">Hasta</label></dt>
				<dd><input type="text" id="cost-until<?php echo $cost->id; ?>" name="cost-until<?php echo $cost->id; ?>" value="<?php echo $cost->until; ?>" /></dd>
                <?php if ($project->itsok('cost-dates'.$cost->id)) echo 'OK'; else echo $project->errors['cost-dates'.$cost->id]; ?>
			</dl>

		 		<span><?php echo Text::get('tooltip project cost'); ?></span><br />
		 	</fieldset>
	<?php endforeach; ?>

    <fieldset>
        <legend>Coste total del proyecto</legend>
        <p>Mínimo: <?php echo $project->mincost; ?> &euro; | Óptimo: <?php echo $project->maxcost; ?> &euro;</p>
        <?php if ($project->itsok('total-costs')) echo 'OK'; else echo $project->errors['total-costs']; ?>
    </fieldset>

	<fieldset>
		<legend>Cuenta con otros recursos?</legend>
		<dl>
			<dt><label for="resource">Otras ayudas económicas o infraestructura</label></dt>
			<dd><textarea id="resource" name="resource" cols="50" rows="5"><?php echo $project->resource; ?></textarea></dd>
		</dl>
        <?php if (!$project->itsok('resource')) echo $project->errors['resource']; ?>
		<span><?php echo Text::get('tooltip project resource'); ?></span><br />
	</fieldset>

	<fieldset>
		<legend>AGENDA</legend>
		Tiempo de producción del proyecto<br />
		<?php foreach ($project->costs as $cost) : ?>
			<p><?php echo "{$cost->cost}. Del {$cost->from} al {$cost->until}"; ?></p>
		<?php endforeach; ?>
	</fieldset>

	<input type="submit" name="submit" value="CONTINUAR" />
</form>
<?php include 'view/project/footer.html.php' ?>
-->


        