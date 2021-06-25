<ul class="pager">
            		<?php
            			for ($i = 1; $i <= $page_count; $i++) {
            				$link_class = $page_num == $i ? 'pager-active' : '';
            				echo "
            					<li class='$link_class'><a href='./index.php?page=$i'>$i</a></li>
            				";
            			}
            		?>	
            	</ul>