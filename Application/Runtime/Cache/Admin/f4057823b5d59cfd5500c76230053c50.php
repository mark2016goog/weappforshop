<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>视频管理-美客系统管理</title>
    <meta name="keywords" content="美客系统管理">
    <meta name="description" content="美客系统管理">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/Public/css/animate.css" rel="stylesheet">
    <link href="/Public/css/style.css?v=4.0.0" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="/Public/js/plugins/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/js/plugins/ueditor/ueditor.all.js"></script>
    

    <base target="_self">
    <style type="text/css">
        .view_image_block{ position: absolute; width: 200px; height: 200px; display: table-cell; overflow: hidden; background: #fff; border: 1px #ddd solid; z-index: 1000;}
        .view_image_block img{ max-width: 200px; text-align: center; margin: 0 auto;}
        .ticketinfo{display:none;}
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>视频列表</h5>

                    <div class="ibox-content">
                        <div class="">
                            <?php if($show): ?><a href="<?php echo U('/short_video/edit');?>" target="_self" class="btn" style="background:#e00214;color:#fff;">发布视频</a><?php endif; ?>
                            <div class="input-group  col-sm-6 pull-right form-group" id='pickfiles'>
                                <div class="col-sm-2 padding-item">
                                    <input type="hidden" name="show" value="<?php echo ($show); ?>" />
                                    <select class="form-control " name="platform">
                                        <option value="0">发布平台</option>
                                        <option value="1" <?php if($platform == 1): ?>selected<?php endif; ?>>H5</option>
                                        <option value="2" <?php if($platform == 2): ?>selected<?php endif; ?>>App</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 padding-item">
                                    <input type="hidden" name="show" value="<?php echo ($show); ?>" />
                             <select class="form-control " name="search">
                                  <option value="0">所有视频</option>
                                  <?php if(is_array($short_video_tag)): $i = 0; $__LIST__ = $short_video_tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><option value="<?php echo ($tag["id"]); ?>" <?php if($class == $tag['id']): ?>selected<?php endif; ?>><?php echo ($tag["tag_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                             </select>
                                    </div>

                                <div class="col-sm-3 padding-item">
                                    <select class="form-control " name="status">
                                        <option value="0">所有状态</option>
                                        <option value="1" <?php if($status == 1): ?>selected<?php endif; ?>>已上架</option>
                                        <option value="4" <?php if($status == 4): ?>selected<?php endif; ?>>已下架</option>
                                        <option value="9" <?php if($status == 9): ?>selected<?php endif; ?>>待转码</option>
                                        <option value="5" <?php if($status == 5): ?>selected<?php endif; ?>>转码失败</option>
                                        <option value="2" <?php if($status == 2): ?>selected<?php endif; ?>>审核驳回</option>
                                        <option value="7" <?php if($status == 7): ?>selected<?php endif; ?>>举报下架</option>
                                    </select>
                                </div>
                                <div class="col-sm-5 padding-item">
                                <input class="form-control" name="kw" value="<?php echo ($kw); ?>"  placeholder="视频标题" type="text" />
                            </div>

                            <div class="input-group-btn">
                              <button type="submit" data-role="search" class="btn btn-sm" style="background:#e00214;color: #fff;">
                                搜索
                              </button>
                            </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover " id="editable">
                            <thead>
                                <tr>
                                    <th>视频ID</th>
                                    <th>视频标题</th>
                                    <th>视频时长</th>
                                    <th>视频大小</th>
                                    <th>权重</th>
                                    <th>播放量</th>
                                    <th>点赞数</th>
                                    <th>分类</th>
                                    <th>平台</th>
                                    <th>上传时间</th>
                                    <th>状态</th>
                                    <th>封面</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr class="gradeX" url="<?php echo ($item["url"]); ?>">
                                        <td><?php echo ($item["id"]); ?></td>
                                        <td title="<?php echo ($item["original_title"]); ?>"><?php echo (mb_substr($item["title"],0,20)); ?></td>
                                        <td><?php echo tans_human_minutes($item[duration]);?></td>
                                        <td><?php echo ($item["size_text"]); ?></td>
                                        <td><?php echo ($item["weight"]); ?></td>
                                        <td><?php echo ($item["play_num"]); ?></td>
                                        <td><?php echo ($item["favorite_num"]); ?></td>
                                        <td>
                                            <?php echo get_video_type($item['type']);?>
                                            <?php if($item["is_hot"] == 1): ?><font color="red" >[推荐]</font><?php endif; ?>
                                        </td>
                                        <td><?php if($item['platform'] == 1): ?>H5<?php elseif($item['platform'] == 2): ?>App<?php else: ?>不限<?php endif; ?></td>
                                        <td><?php echo (date('m-d H:i',$item["create_time"])); ?></td>
                                        <td style="color: #666;"><?php echo get_video_status($item[status]);?></td>
                                        <td align="center">
                                            <?php if($item.pic): ?><img src="<?php echo ($item["pic"]); ?>" class="view_img" data-url="<?php echo ($item["pic"]); ?>" style="max-width: 100px; max-height: 80px" /><?php endif; ?>
                                        </td>
                                        <td class="center" style="white-space: nowrap;">
                                            <?php if(0 == $item[status]): ?>转码中...
                                            <?php elseif(-1 == $item[status]): ?>
                                                <a href="<?php echo U('/short_video/edit', array('id'=>$item['id']));?>"> 重传视频</a>
                                            <?php else: ?>
                                                <?php if(1 == $item['status']): ?><a href="<?php echo U('/short_video/drop', array('id'=>$item['id'],'status'=>4));?>" onclick="return confirm('确定要下架该视频吗？')" class="red">下架</a>
                                                <?php elseif(4 == $item['status']): ?>
                                                    <a href="<?php echo U('/short_video/drop', array('id'=>$item['id'],'status'=>1));?>" onclick="return confirm('确定要上架该视频吗？')" class="red"> 上架</a><?php endif; ?>
                                                <?php if($item[is_show] == '0'): ?><a href="<?php echo U('/short_video/edit', array('id'=>$item['id']));?>" class="red"> 编辑</a><?php endif; ?>
                                                <a href="<?php echo U('/short_video/del', array('id'=>$item['id']));?>" onclick="return confirm('确定要删除该视频吗？')" class="red"> 删除</a>
                                                <a href="<?php echo U('/short_video_comment/index', array('id'=>$item['id']));?>" class="orange"> 管理评论</a><?php endif; ?>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="row ">
                            <div class="pages">
                                <?php echo ($page); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</div>
<!-- 全局js -->
<script src="/Public/js/jquery.min.js?v=2.1.4"></script>
<script src="/Public/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/js/plugins/layer/layer.min.js"></script>
<!-- 自定义js -->
<script src="/Public/js/plugins/layer/laydate/laydate.js"></script>
<script src="/Public/js/content.js?v=1.0.0"></script>
<script src="/Public/js/active-msdt.js?v=1.0.0"></script>

    <script type="text/javascript">
        $('button[data-role="search"]').click(function() {
            window.location.href = "<?php echo U('/short_video/index');?>&class=" + $('select[name="search"]').val()+"&kw="
                    +$('input[name="kw"]').val()+"&status=" + $('select[name="status"]').val()+"&show="+$('input[name="show"]').val()+"&platform="+$('select[name="platform"]').val();
        });

        $("#delete-short_video").click(function() {
            if (!confirm("确定要删除吗？")) {
                return false;
            }
            var idList = [];
            $("input[name='delete-id[]']:checked").each(function() {

                // qcVideo.uploader.deleteFile($(this).parent().parent().attr('url'));

                idList.push($(this).val());
            });
            window.location.href = "/index.php?s=/short_video/delete/list/" + idList.toString() + ".html";
        });
    </script>

<script type="text/javascript">
    $('.view_img').hover(function(e){
        var x = e.pageX;
        var y = e.pageY;
        if($(this).attr('data-url')){
            $(document.body).append("<div class='view_image_block'><img src='"+$(this).attr('data-url')+"' /> </div>");
            $('.view_image_block').css('left',x+'px');
            $('.view_image_block').css('top',y+'px');
        }

    },function(){
        $(".view_image_block").remove();
    });
</script>
</body>
</html>