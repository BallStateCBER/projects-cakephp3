<div class="release">
	<h1>
		<?= $this->Html->link($release->title, [
			'controller' => 'releases', 'action' => 'view', 'id' => $release->id, 'slug' => $release->slug
		]); ?>
	</h1>

	<p class="partner">
		<?= $this->Html->link($release->partner['name'], [
			'controller' => 'partners', 'action' => 'view', 'id' => $release->partner['id'], 'slug' => $release->partner['slug']
		]); ?>
	</p>

	<?php if ($this->request->getSession()->read('Auth.User')): ?>
		<span class="controls">
			<?= $this->Html->link(
				$this->Html->image('/data_center/img/icons/pencil.png').'Edit',
				['controller' => 'releases', 'action' => 'edit', $release->id],
				['escape' => false]
			); ?>
			<?= $this->Form->postLink(
				$this->Html->image('/data_center/img/icons/cross.png').'Delete',
				['controller' => 'releases', 'action' => 'delete', $release->id],
				['escape' => false],
				'Are you sure that you want to delete this release?'
			); ?>
		</span>
	<?php endif; ?>

	<table>
		<tbody>
			<tr>
				<td class="description_col">
					<?= $release->description; ?>

					<?php if (!empty($release->tags)):?>
						<p class="tags">
							Tags:
							<?php
								$tagLinks = [];
								foreach ($release->tags as $tag) {
									$tagLinks[] = $this->Html->link(
										$tag['name'],
										array('controller' => 'tags', 'action' => 'view', 'id' => $tag['id'], 'slug' => $tag['slug'])
									);
								}
								echo implode(', ', $tagLinks);
							?>
						</p>
					<?php endif; ?>

					<?php if (!empty($release->authors)):?>
						<p class="authors">
							<?= __n('Author', 'Authors', count($release->authors)); ?>:
							<?php
								$authorLinks = [];
								foreach ($release->authors as $author) {
									$authorLinks[] = $this->Html->link(
										$author['name'],
										array(
											'controller' => 'authors',
											'action' => 'view',
											$author['id']
										)
									);
								}
								echo implode(', ', $authorLinks);
							?>
						</p>
					<?php endif; ?>

				</td>
				<td class="graphics_col <?= (count($release->graphics) > 1) ? 'graphics_col_double' : 'graphics_col_single'; ?>">
					<p class="date">
						Published <?= date('F j, Y', strtotime($release->released)); ?>
					</p>

					<?php if (!empty($release->graphics)): ?>
						<table>
							<tr>
								<?php foreach ($release->graphics as $k => $graphic): ?>
									<?php if ($k + 1 == count($release->graphics) && $k % 2 == 0): ?>
										<td>
											&nbsp;
										</td>
									<?php endif; ?>
									<td>
										<?php
											$imgSrc = '/img/releases/'.$graphic['dir'].'/'.$this->Graphic->thumbnail($graphic['image']);
											echo $this->Html->link(
												"<div class=\"graphic\"><img src=\"$imgSrc\" /></div>{$graphic['title']}",
												$graphic['url'],
												array('escape' => false)
											);
										?>
									</td>
									<?php if ($k % 2 == 1 && count($release->graphics) > $k + 1): ?>
										</tr>
										<tr>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						</table>
					<?php endif; ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>