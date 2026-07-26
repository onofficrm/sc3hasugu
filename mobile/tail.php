<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}

if (is_file(G5_PATH.'/_site.config.php')) {
    include_once G5_PATH.'/_site.config.php';
}
$mobile_company = function_exists('g5site_cfg') ? g5site_cfg('company_name', '원진하수구') : '원진하수구';
$mobile_phone = function_exists('g5site_cfg') ? g5site_cfg('phone', '') : '';
$mobile_tel = function_exists('g5site_tel_link') ? g5site_tel_link($mobile_phone) : '#';
$mobile_intro = function_exists('g5site_cfg') ? g5site_cfg('footer_desc', '구리시 하수구청소 전화상담') : '구리시 하수구청소 전화상담';
?>
    </div>
</div>


<?php echo poll('basic'); // 설문조사 ?>
<?php echo visit('basic'); // 방문자수 ?>


<div id="ft">
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo get_pretty_url('content', 'company'); ?>">회사소개</a>
            <a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a>
            <a href="<?php echo get_pretty_url('content', 'provision'); ?>">서비스이용약관</a>
        </div>
        Copyright &copy; <b><?php echo get_text($mobile_company); ?></b>. All rights reserved.<br>
    </div>
    <div class="ft_cnt">
        <h2>사이트 정보</h2>
        <p class="ft_info">
        회사명 : <?php echo get_text($mobile_company); ?><br>
            <?php echo get_text($mobile_intro); ?><br>
            전화 : <a href="<?php echo htmlspecialchars($mobile_tel, ENT_QUOTES, 'UTF-8'); ?>"><?php echo get_text($mobile_phone); ?></a><br>
		</p>
    </div>
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
    <?php
    if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
    <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
    <?php
    }

    if ($config['cf_analytics']) {
        echo $config['cf_analytics'];
    }
    ?>
</div>
<script>
jQuery(function($) {

    $( document ).ready( function() {

        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));

        //상단고정
        if( $(".top").length ){
            var jbOffset = $(".top").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '.top' ).addClass( 'fixed' );
                }
                else {
                    $( '.top' ).removeClass( 'fixed' );
                }
            });
        }

        //상단으로
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });

    });
});

//상단고정
$( document ).ready( function() {
    var jbOffset = $( '.top' ).offset();
    $( window ).scroll( function() {
        if ( $( document ).scrollTop() > jbOffset.top ) {
            $( '.top' ).addClass( 'fixed' );
        }
        else {
            $( '.top' ).removeClass( 'fixed' );
        }
    });
});
//상단으로
$(function() {
    $("#top_btn").on("click", function() {
        $("html, body").animate({scrollTop:0}, '500');
        return false;
    });
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");