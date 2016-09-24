<style>
    .dataTables_paginate .disabled {
        background: #eee;
    }

    .paging_simple_numbers {
        float: right;
    }
</style>
<div class="dataTables_wrapper ">
    <span class="dataTables_info">共 <?php echo $page_info['total'];?> 条，<?php echo $page_info['per_page'];?>2222 条/页</span>

    <div class="dataTables_paginate paging_simple_numbers">
        <a class="paginate_button previous{if $page_info['current'] == 1}disabled{/if}"
           href="<?php echo $page_info['url_pre'];?><?php echo $page_info['prev'];?>">上一页</a>

        <span>
            <?php for ($current_page = $page_info['start']; $current_page <= $page_info['end']; $current_page++): ?>
                <a href="{$page_info['url_pre']}{$current_page}"
                   class="paginate_button {if $page_info['current']==$current_page}current{/if}"><?php echo $current_page;?></a>
            <?php endfor; ?>
        </span>

        <a class="paginate_button next {if $page_info['current'] == $page_info['last']}disabled{/if}"
           href="<?php echo $page_info['url_pre'];?><?php echo $page_info['next'];?>">下一页</a>

    </div>
</div>