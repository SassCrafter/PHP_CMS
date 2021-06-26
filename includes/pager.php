<ul class="pager">
	<?php
		for ($i = 1; $i <= $page_count; $i++) {
			$link_class = $page_num == $i ? 'pager-active' : '';
			$url_connector = check_if_has_question_mark($page_url) ? '&page=' : '?page=';
			echo "
				<li class='$link_class'><a href='./$page_url$url_connector$i'>$i</a></li>
			";
		}
	?>	
</ul>