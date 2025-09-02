<div class='input_block input_file_block'>
	<span><?= $title ?>:</span>
	<input id='file_<?= $name ?>' type='file' name='<?= $name ?>[]' multiple='true' min='1' max='999' accept='<?= $accept ?>' <?= $required ? 'required' : '' ?>>
	<label for='file_<?= $name ?>'>Выбрать файл</label>
</div>


<?php if (!empty($objects)): ?>
	<table class='table mt15'>
		<thead>
			<tr>
				<th style='width: 20px; text-align: center;'>
					№
				</th>
				<th>
					Файл
				</th>
				<th style='width: 42px; text-align: center;'>-</th>
				<th style='width: 42px; text-align: center;'>-</th>
			</tr>
		</thead>
		<tbody class='sortbox'>
			<? $i = 1; ?>
			<? foreach($objects AS $object) : ?>
				<tr class='filter'>
					<td class='nums' style='text-align: center;'><?= $i ?></td>
					<td style='padding: 0px;'>
						<input type='text' name='files_name[]' class='input' required value='<?= $object->filename ?>'>
						<input type='hidden' name='files_id[]' value='<?= $object->id ?>'>
						<input type='hidden' name='files_rate[]' class='rate' value='<?= $object->rate ?>'>
					</td>
					<td style='padding: 0px;'>
						<a href='<?= $object->file ?>' target='_blank' class='img_preview_open'></a>
					</td>
					<td style='padding: 0px;'>
						<button type='button' class='file_delete' data-id='<?= $object->id ?>' data-class='<?= get_class($object) ?>' data-field='<?= $name ?>'></button>
						<input type='hidden' name='files_del[]' id='file_del<?= $object->id ?>' value='0'>
					</td>
				</tr>
				<? $i++; ?>
			<? endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>