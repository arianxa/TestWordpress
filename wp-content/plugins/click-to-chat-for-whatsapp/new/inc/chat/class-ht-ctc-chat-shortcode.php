<?php
/**
* shortcodes 
* for list of attribute support check  -> shortcode_atts ( $a )
*
* @package chat
* @since 2.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Chat_Shortcode' ) ) :
    
class HT_CTC_Chat_Shortcode {


    //  Register shortcode
    public function shortcodes_init() {
        add_shortcode( 'ht-ctc-chat', array( $this, 'shortcode' ) );
    }

    // call back function - shortcode 
    public function shortcode( $atts = [], $content = null, $shortcode = '' ) {

        $options = get_option( 'ht_ctc_chat_options' );
        $main_options = ht_ctc()->values->ctc_main_options;

        $number_db = esc_attr( $options['number'] );
        $call_to_action_db = esc_attr( $options['call_to_action'] );
        $pre_filled_db = esc_attr( $options['pre_filled'] );

        $number = __( $number_db , 'click-to-chat-for-whatsapp' );
        $call_to_action = __( $call_to_action_db , 'click-to-chat-for-whatsapp' );
        $pre_filled = __( $pre_filled_db , 'click-to-chat-for-whatsapp' );

        $style_desktop = esc_attr( $options['style_desktop'] );
        $style_mobile = esc_attr( $options['style_mobile'] );

        $is_mobile = ht_ctc()->device_type->is_mobile();

        $style = $style_desktop;;
        if ( 'yes' == $is_mobile ) {
            $style = $style_mobile;
        }

        // $content = do_shortcode($content);

        // $ccw_options_cs = get_option('ccw_options_cs');
        //  use like  $ccw_options_cs['']
        
        $a = shortcode_atts(
            array(
                'number' => $number,
                'call_to_action' => $call_to_action,
                'pre_filled' => $pre_filled,
                'style' => $style,
                
                'position' => '',
                'top' => '',
                'right' => '',
                'bottom' => '',
                'left' => '',
                'home' => '',  // home -  to hide on experts .. 
                'hide_mobile' => '',
                'hide_desktop' => '',
                // 'inline_issue' => '',
                
                's5_img_position' => '',  //left, right
                's8_width' => '',
                's8_icon_position' => '',  // left, right, hide
                
            ), $atts, $shortcode );
        // use like -  '.$a["title"].'   
        

        // number
        $number   = $a["number"];

        // pre-filled text
        $page_url = get_permalink();
        $page_title = esc_html( get_the_title() );

        $pre_filled = $a["pre_filled"];
        
        $pre_filled = str_replace( '{{url}}', $page_url, $pre_filled );
        $pre_filled = str_replace( '{{title}}', $page_title, $pre_filled );
    
        // hide on devices
        // if 'yes' then hide
        $hide_mobile = $a["hide_mobile"];
        $hide_desktop = $a["hide_desktop"];
        
        if( 'yes' == $is_mobile ) {
            if ( 'yes' == $hide_mobile ) {
                return;
            }
        } else {
            if ( 'yes' == $hide_desktop ) {
                return;
            }
        }
        
        
        
        $position   = $a["position"];
        $top        = $a["top"];
        $right      = $a["right"];
        $bottom     = $a["bottom"];
        $left       = $a["left"];
        
        $css = '';

        if ( '' !== $position ) {
            $css .= 'position:'.$position.';';
        }
        if ( '' !== $top ) {
            $css .= 'top:'.$top.';';
        }
        if ( '' !== $right ) {
            $css .= 'right:'.$right.';';
        }
        if ( '' !== $bottom ) {
            $css .= 'bottom:'.$bottom.';';
        }
        if ( '' !== $left ) {
            $css .= 'left:'.$left.';';
        }

        // to hide styles in home page
        $home       = $a["home"];

        // $position !== 'fixed' why !== to avoid double time adding display: none .. 
        if ( 'fixed' !== $position && 'hide' == $home && ( is_home() || is_category() || is_archive() ) ) {
                $css .= 'display:none;';
        }

        // By default postion: fixed style hide on home screen, 
        // if plan to show, then add hide='show' ( actually something not equal to 'hide' )
        if ( 'fixed' == $position && 'show' !== $home &&  ( is_home() || is_category() || is_archive() ) ) {
            $css .= 'display:none;';
        }

        $web_api = 'web';

        // mobile
        if ( 'yes' == $is_mobile ) {
            $web_api = 'api';
        } else {
            $web_api = 'web';
        }

        // if cache issue
        if ( isset ( $options['cache_issue'] ) ) {
            $web_api = 'api';
        }

        $link = "https://$web_api.whatsapp.com/send?phone=$number&text=$pre_filled";
        $return_type = "chat";

        $style = $a["style"];

        // call to action
        $call_to_action   = $a["call_to_action"];
        $class_names = "ht-ctc-sc-chat sc-style-$style";

        // analytics
        $is_ga_enable = 'no';
        $is_fb_an_enable = 'no';

        if ( isset( $main_options['google_analytics'] ) ) {
            $is_ga_enable = 'yes';
        }

        if ( isset( $main_options['fb_analytics'] ) ) {
            $is_fb_an_enable = 'yes';
        }


        $o = '';

        // shortcode template file path
        $sc_path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles-shortcode/sc-style-' . $style. '.php';

        if ( is_file( $sc_path ) ) {
            $o .= '<div onclick="ht_ctc_shortcode_click(this);" data-ctc-link="'.$link.'" data-return_type="'.$return_type.'" data-is_ga_enable="'.$is_ga_enable.'" data-is_fb_an_enable="'.$is_fb_an_enable.'" style="display: inline; cursor: pointer; z-index: 99999999; '.$css.'" class="'.$class_names.' ht-ctc-inline">';
            include $sc_path;
            $o .= '</div>';
        } else {
            // if style is not in the list.. 
            $img_link = plugins_url("./new/inc/assets/img/whatsapp-logo.png", HT_CCW_PLUGIN_FILE );
            $o .= '<div class="ccw_plugin">';
            $o .= '<img class="img-icon-sc sc_item pointer style-3-sc" src="'.$img_link.'" alt="WhatsApp chat" onclick="'.$img_click_link.'" style="height: 36px; '.$css.' " >';
            $o .= '</div>';
        }

        
        return $o;

    }


}


$shortcode = new HT_CTC_Chat_Shortcode();

add_action('init', array( $shortcode, 'shortcodes_init' ) );

endif; // END class_exists check