{include "admin/public/header.tpl.php"}<style>    .dropDown-menu li .on {        background-color: #eee;        color: red;    }</style><header class="f-ui-header cl">    <a class="f-ui-logo l cancel-off-png" title="后台管理" href="/">后台管理</a>    <ul class="f-ui-userbar">        <li class="dropDown dropDown_hover">            <a href="#" class="dropDown_A">当前语言：                {if $lang['current_lang'] == en_US} 汉语{/if}                <!--                        {if $lang['current_lang'] == en_US} 英语{/if}-->                <!--                        {if $lang['current_lang'] == ja_JP}日语{/if}-->                <!--                        {if $lang['current_lang'] == ko_KR}韩语{/if}-->                <i class="f-ui-iconfont">&#xe6d5;</i>            </a>            <ul class="dropDown-menu radius box-shadow">                <li><a href="?lang=zh_CN" {if $lang['current_lang'] == zh_CN}class="on"{/if}>汉语</a></li>                <!--                <li><a href="?lang=en_US" {if $lang['current_lang'] == en_US}class="on"{/if}>英语</a></li>-->                <!--                <li><a href="?lang=ja_JP" {if $lang['current_lang'] == ja_JP}class="on"{/if}>日语</a></li>-->                <!--                <li><a href="?lang=ko_KR" {if $lang['current_lang'] == ko_KR}class="on"{/if}>韩语</a></li>-->            </ul>        </li>        <li><?php echo FSession::get('manager_role_name'); ?></li>        <li><a target="_blank" href="/">查看前台</a></li>        <li><a href="javascript:;" onclick="member_add('更新缓存','/admin/cache/clear','','500')" href="/">更新缓存</a></li>        <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo FSession::get('manager_name'); ?>                <i                    class="f-ui-iconfont">&#xe6d5;</i></a>            <ul class="dropDown-menu radius box-shadow">                <!--                <li><a href="/admin/manager/myInfo">个人信息</a></li>-->                <!--                <li><a href="/admin/public/changeUser">切换账户</a></li>-->                <li><a href="/admin/public/logout">退出</a></li>            </ul>        </li>        <!--        <li id="f-ui-msg"><a href="#" title="消息"><span class="badge badge-danger">1</span><i class="f-ui-iconfont"-->        <!--                                                                                            style="font-size:18px">-->        <!--                    &#xe68a;</i></a></li>-->        <li id="f-ui-skin" class="dropDown right dropDown_hover"><a href="javascript:;" title="换肤"><i                    class="f-ui-iconfont" style="font-size:18px">&#xe62a;</i></a>            <ul class="dropDown-menu radius box-shadow">                <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>                <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>                <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>                <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>                <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>                <li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>            </ul>        </li>    </ul>    <a aria-hidden="false" class="f-ui-nav-toggle" href="#"></a></header><aside class="f-ui-aside no-skin">    <ul class="nav nav-list" id="left-nav">        <?php        $modelT = new FTable('model');        $modelData = $modelT->order("sort asc")->select();        foreach ($modelData as $m):            if ($m['table_rel'] || $m['table_name'] == 'default_summary') {                continue;            }            ?>            <li class="nav-item <?php if (0): ?>open active<?php endif; ?>">                <a href="#" class="dropdown-toggle">                    <i class="menu-icon fa fa-book"></i>                    <span class="menu-text"> {$m.model_name}管理</span>                    <b class="arrow fa fa-angle-down"></b>                </a>                <b class="arrow"></b>                <ul class="submenu nav-hide" style="display: ;">                    <li>                        <a href="/admin/content/index?model={$m.id}">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> {$m.model_name}列表</span>                        </a>                        <b class="arrow"></b>                    </li>                    <?php if ($m['has_cate']): ?>                        <li>                            <a href="/admin/content/category?model={$m.id}">                                <i class="menu-icon fa fa-caret-right"></i>                                <span class="sub_menu-text"> 栏目管理</span>                            </a>                            <b class="arrow"></b>                        </li>                    <?php endif; ?>                    <?php                    $modelRel = $modelT->where("table_rel='{$m['table_name']}'")->order("sort asc")->select();                    foreach ($modelRel as $_model_rel):                        ?>                        <li>                            <a href="/admin/content/index?model={$_model_rel['id']}">                                <i class="menu-icon fa fa-caret-right"></i>                                <span class="sub_menu-text"> {$_model_rel['model_name']}</span>                            </a>                            <b class="arrow"></b>                        </li>                    <?php endforeach; ?>                </ul>            </li>        <?php endforeach; ?>        <li class="nav-item">            <a href="#" class="dropdown-toggle">                <i class="menu-icon fa fa-cog"></i>                <span class="menu-text"> 系统管理</span>                <b class="arrow fa fa-angle-up"></b>            </a>            <b class="arrow"></b>            <ul class="submenu nav-show" style="display: ;">                <li class="">                    <a href="/admin/fragment/index">                        <i class="menu-icon fa fa-caret-right"></i>                        <span class="sub_menu-text"> 杂项</span>                    </a>                    <b class="arrow"></b>                </li>                <li class="">                    <a href="/admin/admin/index">                        <i class="menu-icon fa fa-caret-right"></i>                        <span class="sub_menu-text"> 管理员列表</span>                    </a>                    <b class="arrow"></b>                </li>                <li class="">                    <a href="/admin/global/setting">                        <i class="menu-icon fa fa-caret-right"></i>                        <span class="sub_menu-text"> 系统设置</span>                    </a>                    <b class="arrow"></b>                </li>                <li class="">                    <a href="/admin/model/index">                        <i class="menu-icon fa fa-caret-right"></i>                        <span class="sub_menu-text"> 模型管理</span>                    </a>                    <b class="arrow"></b>                </li>                <li class="">                    <a href="/admin/system/log">                        <i class="menu-icon fa fa-caret-right"></i>                        <span class="sub_menu-text"> 系统日志</span>                    </a>                    <b class="arrow"></b>                </li>            </ul>        </li>        <?php if (0): ?>            <li class="open">                <a href="#" class="dropdown-toggle">                    <i class="menu-icon fa fa-briefcase"></i>                    <span class="menu-text"> 财务管理 </span>                    <b class="arrow fa fa-angle-up"></b>                </a>                <b class="arrow"></b>                <ul class="submenu nav-show" style="display: block;">                    <li class="">                        <a href="#" data-url="/funds/admin/index.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 充值/扣款</span>                        </a>                        <b class="arrow"></b>                    </li>                    <li class="">                        <a href="#" data-url="/funds/bonus/index.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 会员奖金记录</span>                        </a>                        <b class="arrow"></b>                    </li>                    <li class="">                        <a href="#" data-url="/funds/finance/index.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 会员财务记录</span>                        </a>                        <b class="arrow"></b>                    </li>                    <li class="">                        <a href="#" data-url="/funds/transfer/index.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 转账记录</span>                        </a>                        <b class="arrow"></b>                    </li>                    <li class="">                        <a href="#" data-url="/funds/payorder/index.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 网银储值</span>                        </a>                        <b class="arrow"></b>                    </li>                    <li class="">                        <a href="#" data-url="/funds/postcash/index.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> LDC提现管理</span>                        </a>                        <b class="arrow"></b>                    </li>                </ul>            </li>            <li class="">                <a href="#" class="dropdown-toggle">                    <i class="menu-icon fa fa-bar-chart-o"></i>							<span class="menu-text">                                    统计管理                            </span>                    <b class="arrow fa fa-angle-down"></b>                </a>                <b class="arrow"></b>                <ul class="submenu">                    <li class="">                        <a href="#" data-url="/bonus/statistics/getList.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 奖金统计</span>                        </a>                        <b class="arrow"></b>                    </li>                </ul>            </li>            <li class="">                <a href="#" class="dropdown-toggle">                    <i class="menu-icon fa fa-share-alt"></i>							<span class="menu-text">                                    网络管理                            </span>                    <b class="arrow fa fa-angle-down"></b>                </a>                <b class="arrow"></b>                <ul class="submenu">                    <li class="">                        <a href="#" data-url="/tree/arrange/init.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 安置树</span>                        </a>                        <b class="arrow"></b>                    </li>                    <li class="">                        <a href="#" data-url="/tree/net/init.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 网络树</span>                        </a>                        <b class="arrow"></b>                    </li>                    <li class="">                        <a href="#" data-url="/tree/recommend/init.ahtml">                            <i class="menu-icon fa fa-caret-right"></i>                            <span class="sub_menu-text"> 推荐树</span>                        </a>                        <b class="arrow"></b>                    </li>                </ul>            </li>        <?php endif; ?>    </ul>    <script type="text/javascript">        $('#left-nav .nav-item a.dropdown-toggle').click(function () {            var parent = $(this).parent();            if (parent.hasClass("open")) {                parent.removeClass("open");            } else {                $('#left-nav .nav-item').removeClass("open");                parent.addClass("open");            }        });    </script></aside><div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div><section class="f-ui-article-box">    <div id="f-ui-tabNav" class="f-ui-tabNav">        <div class="f-ui-tabNav-wp">            <ul id="min_title_list" class="acrossTab cl">                <li class="active"><span title="我的桌面" data-href="welcome.tpl">我的桌面</span><em></em></li>            </ul>        </div>        <div class="f-ui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S"                                                  href="javascript:;"><i class="f-ui-iconfont">&#xe6d4;</i></a><a                id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i                    class="f-ui-iconfont">&#xe6d7;</i></a></div>    </div>    <div id="iframe_box" class="f-ui-article">        <div class="show_iframe">            <div style="display:none" class="loading"></div>            <iframe scrolling="yes" frameborder="0" src="/admin/Welcome/index"></iframe>        </div>    </div></section><script type="text/javascript">    /*资讯-添加*/    function article_add(title, url) {        var index = layer.open({            type: 2,            title: title,            content: url        });        layer.full(index);    }    /*图片-添加*/    function picture_add(title, url) {        var index = layer.open({            type: 2,            title: title,            content: url        });        layer.full(index);    }    /*产品-添加*/    function product_add(title, url) {        var index = layer.open({            type: 2,            title: title,            content: url        });        layer.full(index);    }    /*用户-添加*/    function member_add(title, url, w, h) {        layer_show(title, url, w, h);    }</script><script type="text/javascript"></script>{include "admin/public/footer.tpl.php"}