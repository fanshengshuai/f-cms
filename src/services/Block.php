<?php

class Service_Block {
    public static function getBlockItems($bid) {
        global $_F;

        if (is_array ( $bid )) {
            $bid_str = join ( "','", $bid );
            $bid_str = "'{$bid_str}'";
        } else {
            $bid_str = $bid;
        }

        $cacheKey = "block-items-{$bid}";
        $content = FCache::get($cacheKey);
        if ($content) {
//            $_F ['blocks'][$bid]
//            return $content;
        }

        $block_infos = FDB::fetch ( "select * from block where bid in ($bid_str)" );

        foreach ( $block_infos as $block_info ) {
            if ($block_info ['shownum']) {
                $limit = ' limit ' . $block_info ['shownum'];
            }

            $sql = "select * from block_item where bid='{$block_info['bid']}' and status=1 order by sort asc {$limit}";
            $block_info ['items'] = FDB::fetch ( $sql );

            foreach ($block_info ['items'] as $key => $value) {
                if (strpos ( $block_info ['items'] [$key] ['pic'], 'ttp:' ) != false) {
                    $block_info ['items'] [$key] ['pic'] = "{$block_info ['items'] [$key] ['pic']}";
                } else {
                    $block_info ['items'] [$key] ['pic'] = "{$_F['static_url']}/uploads/{$block_info ['items'] [$key] ['pic']}";
                }
            }

            $_F ['blocks'] [$block_info ['bid']] = $block_info;
        }
    }
}
