{include "front/public/header.tpl.php"}

<div class="container">
    <h1>工程目录
        <small>请按下面目录布局工程</small>
    </h1>
    <div class="row">
        <pre>/ （项目根目录）
├── vendor/
├── src/
│   ├── config/
│   ├── res/
│   │   ├── admin
│   │   ├── fonts
│   │   ├── lib
│   │   └── common
│   └── modules/
│   │   ├── admin
│   │   ├── mobile
│   │   └── front
│   └── tpl/
└── docs/
    └── examples/
        </pre>

    </div>
    <div class="row">
        网站文件存放于src目录下，相应的 nginx 的更目录也要指定到 src
    </div>
</div>



<script type="text/javascript">
    layer.alert("已经全部加载");
</script>
{include "front/public/footer.tpl.php"}

