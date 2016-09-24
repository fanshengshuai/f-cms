{include "admin/public/header.tpl.php"}

<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:history.back(-1)" class="btn btn-danger radius">返回推荐列表</a></span> </div>
<div class="pd-20">
    <form action="/admin/Recommend/add" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-4"><span class="c-red">*</span>推荐标题：</label>
            <div class="formControls col-4">
                <input type="text" class="input-text" placeholder="" id="title" name="title" value="<?php echo $info['title'];?>">
                <input type="hidden" name="id" value="<?php echo $info['id'];?>"/>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-4"><span class="c-red">*</span>推荐分类：</label>
            <div class="formControls col-4">
                <span class="select-box">
				<select name="cat_id" class="select" id="cat_id_select">
                    <option value="0">请选择</option>
                    <option value="1" {if $info['cat_id'] == 1} selected="selected"{/if}>国内-会员企业推介</option>
                    <option value="2" {if $info['cat_id'] == 2} selected="selected"{/if}>于家村-会员风采</option>
                    <option value="3" {if $info['cat_id'] == 3} selected="selected"{/if}>E辣椒-推荐企业</option>
                </select>
				</span>
            </div>

        </div>
        <div class="row cl">
            <label class="form-label col-4">排序：</label>
            <div class="formControls col-4">
                <input type="text" class="input-text" value="<?php echo $info['sort'] ;?>" placeholder="链接网址" id="" name="sort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-4">URL：</label>
            <div class="formControls col-4">
                <input type="text" class="input-text" value="<?php echo $info['url'];?>" placeholder="链接网址" id="" name="url">
            </div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-4">
                <button class="btn btn-primary radius" type="submit">提交</button>
                <button class="btn btn-default radius" type="reset">取消</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('#form-article-add').submit(function(){
        var title = $('#title').val();
        var select = $('#cat_id_select').val();
        if(title == 0){
            alert('请填写标题！');
            return false;
        }
        if(select == 0){
            alert('请选择分类栏目！');
            return false;
        }
    });
</script>
{include "admin/public/footer.tpl.php"}