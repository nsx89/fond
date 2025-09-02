<div itemscope="" itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
	<!-- <a href="/admin/pages" class="path" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
		<span itemprop="item"><span itemprop="name">Главная</span></span>
	</a> -->
	<? 
		$i = 1; 
		foreach($bread AS $bc) : ?>
			<? if($i != 1) : ?>
				<span class="path_arr">></span> 
			<? endif; $i++; ?>

			<? if($bc['id'] != $ids || $f == 1): ?>
				<a href="<?= $bc['url'] ?>" class="path" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
					<span itemprop="item"><span itemprop="name"><?= strip_tags($bc['name']) ?></span></span>
				</a>
			<? else : ?>
				<span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
					<span itemprop="item" class="path" data-href="<?= $bc['url'] ?>"><span itemprop="name"><?= strip_tags($bc['name']) ?></span></span>
				</span>
			<? endif; ?>

	<? endforeach; ?>
</div>