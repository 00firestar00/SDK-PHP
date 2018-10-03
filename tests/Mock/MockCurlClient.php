<?php


namespace OntraportAPI\tests\Mock;

use OntraportAPI\CurlClient;
use OntraportAPI\Ontraport as O;

class MockCurlClient extends CurlClient
{


    public function httpRequest($requestParams, $url, $method, $requiredParams, $options)
    {
        $API_BASE = O::REQUEST_URL . '/' . O::API_VERSION . '/';

        if($this->str_contains($url, 'Contact') or $this->str_contains($url, 'object')) {
            if (($url === $API_BASE . 'Contact' or $url === $API_BASE . 'object') and $method === 'get') {
                return $this->getSingle('contact');
            } elseif (($url === $API_BASE . 'Contact' or $url === $API_BASE . 'object') and $method === 'delete') {
                return $this->deleteSingleContact();
            } elseif (($url === $API_BASE . 'Contacts/getInfo'or $url === $API_BASE . 'objects/getInfo')) {
                return $this->getInfo('contact');
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'get') {
                return $this->getMultiple('contacts');
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'delete') {
                return $this->deleteMultipleContacts();
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'post') {
                return $this->create('contact');
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'put') {
                return $this->update('contact');
            } elseif ($url === $API_BASE . 'Contacts/meta' or $url === $API_BASE . 'objects/meta') {
                return $this->getMeta('contact');
            } elseif ($url === $API_BASE . 'Contacts/saveorupdate' or $url === $API_BASE . 'objects/saveorupdate') {
                return $this->saveOrUpdateContact();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'get') {
                return $this->retrieveFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'post') {
                return $this->createFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'put') {
                return $this->updateFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'delete') {
                return $this->deleteFields();
            }

            //Applicable to Objects but not contacts
            elseif ($url === $API_BASE . 'objects/tagByName' and $method === 'put') {
                return $this->tagObjectByName();
            } elseif ($url === $API_BASE . 'objects/tagByName' and $method === 'delete') {
                return $this->removeTagByName();
            } elseif ($url === $API_BASE . 'object/getByEmail' and $method === 'get') {
                return $this->getObjectByEmail();
            } elseif ($url === $API_BASE . 'objects/tag' and $method === 'get') {
                return $this->getObjectsWithTag();
            } elseif ($url === $API_BASE . 'objects/pause'){
                return $this->pause();
            } elseif ($url === $API_BASE . 'objects/unpause'){
                return $this->unpause();
            } elseif ($url === $API_BASE . 'objects/sequence' and $method === 'put'){
                return $this->addToSequence();
            } elseif ($url === $API_BASE . 'objects/sequence' and $method === 'delete'){
                return $this->removeFromSequence();
            } elseif ($url === $API_BASE . 'objects/subscribe' and $method === 'put'){
                return $this->subscribe();
            } elseif ($url === $API_BASE . 'objects/subscribe' and $method === 'delete'){
                return $this->unsubscribe();
            } elseif ($url === $API_BASE . 'objects/tag' and $method === 'put'){
                return $this->addTag();
            } elseif ($url === $API_BASE . 'objects/tag' and $method === 'delete'){
                return $this->removeTag();
            }

        } elseif($this->str_contains(strtolower($url), 'task')) {
            if ($url === $API_BASE . 'task/assign') {
                return $this->assignTask();
            } elseif ($url === $API_BASE . 'task/reschedule') {
                return $this->rescheduleTask();
            } elseif ($url === $API_BASE . 'task/cancel') {
                return $this->cancelTask();
            } elseif ($url === $API_BASE . 'task/complete') {
                return $this->completeTask();
            } elseif ($url === $API_BASE . 'Task' and $method === 'get') {
                return $this->getSingle('task');
            } elseif ($url === $API_BASE . 'Tasks' and $method === 'get') {
                return $this->getMultiple('tasks');
            } elseif ($url === $API_BASE . 'Tasks/getInfo') {
                return $this->getInfo('task');
            } elseif ($url === $API_BASE . 'Tasks/meta') {
                return $this->getMeta('task');
            } elseif ($url === $API_BASE . 'Tasks' and $method === 'put') {
                return $this->update('task');
            }
        } elseif($this->str_contains(strtolower($url), 'message')) {
            if ($url === $API_BASE . 'Message' and $method === 'get') {
                return $this->getSingle('message');
            } elseif ($url === $API_BASE . 'Messages' and $method === 'get') {
                return $this->getMultiple('messages');
            } elseif ($url === $API_BASE . 'Messages/getInfo') {
                return $this->getInfo('message');
            } elseif ($url === $API_BASE . 'Messages/meta') {
                return $this->getMeta('message');
            } elseif ($url === $API_BASE . 'message' and $method === 'post') {
                return $this->create('message');
            } elseif ($url === $API_BASE . 'message' and $method === 'put') {
                return $this->update('message');
            }
        } elseif($this->str_contains(strtolower($url), 'form')) {
            if ($url === $API_BASE . 'Form' and $method === 'get') {
                return $this->getSingle('form');
            } elseif ($url === $API_BASE . 'Forms' and $method === 'get') {
                return $this->getMultiple('forms');
            } elseif ($url === $API_BASE . 'Forms/getInfo') {
                return $this->getInfo('form');
            } elseif ($url === $API_BASE . 'Forms/meta') {
                return $this->getMeta('form');
            } elseif ($url === $API_BASE . 'Form/getBlocksByFormName') {
                return $this->getBlocksByFormName();
            } elseif ($url === $API_BASE . 'Form/getAllFormBlocks') {
                return $this->getAllFormBlocks();
            } elseif ($url === $API_BASE . 'form') {
                return $this->getSmartFormData();
            }
        }



return parent::httpRequest($requestParams, $url, $method, $requiredParams, $options);
    }

    function str_contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    function getSingle($objectTypeToGet)
    {
        if($objectTypeToGet === 'contact')
        {
            return "{
  \"code\": 0,
  \"data\": {
    \"id\": \"1\",
    \"owner\": \"1\",
    \"firstname\": \"unit\",
    \"lastname\": \"test\"
  },
  \"account_id\": 50
}";
        } elseif($objectTypeToGet === 'message')
        {
            return '{
  "code": 0,
  "data": {
    "id": "5",
    "alias": "task_title",
    "tags": "",
  },
  "account_id": 187157
}';
        } elseif($objectTypeToGet === 'task')
        {
            return '{
  "code": 0,
  "data": {
    "id": "1",
    "owner": "1",
    "drip_id": "0",
    "contact_id": "2",
    "step_num": "0",
    "subject": "task_subject_here",
    "date_assigned": "1538513596",
    "date_due": "1538859196",
    "date_complete": null,
    "status": "0",
    "type": "0",
    "details": "task instructions go here!",
    "hidden": "0",
    "call_outcome_id": "0",
    "item_id": "5",
    "notifications": null,
    "rules": null,
    "object_type_id": "0",
    "object_name": "Contacts"
  },
  "account_id": 187157
}';
        } elseif($objectTypeToGet === 'form') {
            return '{
  "code": 0,
  "data": {
    "owner": "1",
    "date": 1538599582,
    "object_type_id": 0,
    "json_raw_object": "{\"formWidth\":\"480px\",\"formHeight\":600,\"borderActive\":true,\"borderColor\":\"#fff\",\"borderSize\":\"5px\",\"formData\":[{\"templateId\":\"3153\",\"status\":true,\"blocks\":[{\"alias\":\"Banner\",\"blockId\":\"25\",\"blockTypeId\":3,\"id\":\"1ab78bee-3b9d-b1f5-85ac-a8dd21bc153d\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/25_call_to_action_banner\\/\",\"theme\":{\"spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"50px\",\"padding-bottom\":\"0px\"}}}},\"color_variation\":\"option-4\"},\"userDefinedData\":[{\"id\":\"block-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/blocks\\/block25\\/office-tint-2guys.jpg\",\"options\":[\"blocks\\/block25\\/\"],\"alias\":\"block background\",\"src\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/blocks\\/block25\\/office-tint-2guys.jpg\",\"fixed-width-default\":false}},{\"id\":\"header-1\",\"type\":\"html\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"html\":\"<span class=\\\"wysiwyg-text-align-center h3\\\">Big things start small.<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Header\"}},{\"id\":\"subHeader-1\",\"type\":\"html\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"html\":\"<div><span class=\\\"wysiwyg-text-align-center\\\">One year ago we opened the doors to our business.<\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\">&nbsp;<\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\">Since then we have been lucky enough to have incredible clients like you passing on the good word about us.&nbsp;<\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\"><br><\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\">Please consider sharing this page with your friends & in doing so helping us accomplish our \'big\' goals!<\\/span><\\/div>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Sub-Header\"}},{\"id\":\"button-1\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"hidden\",\"alias\":\"Button\",\"html\":\"SIGN ME UP\",\"href\":\"javascript:\\/\\/\",\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":null,\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\"}}],\"visibility\":true,\"direction\":-1,\"scripts\":\" \\/*block scripts*\\/\",\"extraClasses\":\"opt-page-size-mobile\",\"permissionLevel\":\"free\"},{\"alias\":\"Social sharing\",\"blockId\":\"29\",\"blockTypeId\":13,\"id\":\"9fcb2cdf-6dc8-e848-9d23-56f16cc9cc49\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/29_social_links\\/\",\"theme\":{\"spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"20px\",\"padding-bottom\":\"0px\"}}}}},\"userDefinedData\":[{\"id\":\"block-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"\",\"options\":[],\"alias\":\"block background\",\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/noslide.png\",\"fixed-width-default\":false}},{\"id\":\"social-link-1\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 1\",\"href\":null,\"target\":\"_self\",\"data-social-flavor\":\"facebook\"}},{\"id\":\"social-1\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Facebook\",\"visibility\":\"visible\"}},{\"id\":\"social-link-2\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 2\",\"href\":null,\"target\":\"_self\",\"data-social-flavor\":\"twitter\"}},{\"id\":\"social-2\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Twitter\",\"visibility\":\"visible\"}},{\"id\":\"social-link-3\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 3\",\"href\":null,\"target\":\"_self\",\"data-social-flavor\":\"linkedin\"}},{\"id\":\"social-3\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"LinkedIn\",\"visibility\":\"visible\"}},{\"id\":\"social-sharing-1\",\"type\":\"social-sharing group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"Social Sharing\",\"data-current-iconset\":\"color-icons\",\"social-flavor-order\":\"social-1,social-2,social-3,social-70e7c343-57d9-4af6-91df-bc7106afed0a,social-86b7edd4-4e27-8030-4a20-bd04641ce008,social-8efa090e-df5a-9729-6710-d276cf0e05ea\",\"social-iconsize\":\"48px\",\"data-social-iconsize-responsive\":null,\"min\":\"1\",\"max\":\"20\"}},{\"id\":\"social-link-86b7edd4\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 86b7edd4\",\"href\":null,\"target\":\"_self\",\"data-social-flavor\":\"instagram\"}},{\"id\":\"social-86b7edd4-4e27-8030-4a20-bd04641ce008\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Instagram\",\"visibility\":\"visible\"}},{\"id\":\"social-link-8efa090e\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 8efa090e\",\"href\":null,\"target\":\"_self\",\"data-social-flavor\":\"pinterest\"}},{\"id\":\"social-8efa090e-df5a-9729-6710-d276cf0e05ea\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Pinterest\",\"visibility\":\"visible\"}},{\"id\":\"social-link-bf831dea\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link bf831dea\",\"href\":null,\"target\":\"_self\",\"data-social-flavor\":\"behance\"}},{\"id\":\"social-bf831dea-0b3c-4403-0e61-c6649aec4ffc\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"B\\u0113hance\",\"visibility\":\"visible\"}},{\"id\":\"social-link-70e7c343\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 70e7c343\",\"href\":null,\"target\":\"_self\",\"data-social-flavor\":\"googleplus\"}},{\"id\":\"social-70e7c343-57d9-4af6-91df-bc7106afed0a\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Google+\",\"visibility\":\"visible\"}}],\"visibility\":true,\"scripts\":\"\\/* block scripts *\\/\",\"extraClasses\":\"opt-page-size-mobile\",\"permissionLevel\":\"free\"},{\"alias\":\"Divider\",\"blockId\":\"110\",\"blockTypeId\":19,\"id\":\"3b5a309e-2838-a570-c130-502336307eac\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/110_divider_button\\/\",\"scripts\":\"\\/* block scripts *\\/\\n;( function(){\\n    function resizeHandler110( block110Uid ) {\\n        var $block = $( block110Uid ),\\n            $btn = $block.find( \'.block-style-110__button\' ),\\n            topPadding = parseInt( $block.find( \'.block-style-110__page-separator__top\' ).css( \'padding-top\' ) ),\\n            bottomPadding = parseInt( $block.find( \'.block-style-110__page-separator__bottom\' ).css( \'padding-bottom\' ) ),\\n            paddingDiff = topPadding - bottomPadding,\\n            width = $btn.outerWidth(),\\n            height = $btn.outerHeight(),\\n            marginTop = ( paddingDiff - height )\\/2;\\n        $btn.css( {\\n            \\\"marginLeft\\\": \\\"-\\\" + ( width \\/ 2 ) + \\\"px\\\",\\n            \\\"marginTop\\\": marginTop + \\\"px\\\",\\n            \\\"left\\\": \\\"50%\\\"\\n        } );\\n\\n        $block = $btn = null;\\n    }\\n\\n    $( window ).on( \\\"resize\\\", _.throttle( function(){\\n        resizeHandler110( \'\\/*opt-uuid-class*\\/\' );\\n    }, 500 ) );\\n\\n    var $block = $( \'\\/*opt-uuid-class*\\/\' ),\\n        $btn = $block.find( \'.block-style-110__button\' );\\n\\n    \\/\\/ check if button has img inside. If true, position button after image has loaded, otherwise just call resizeHandler\\n    if ( $btn.hasClass( \'opt-image-button\' ) ) {\\n        $btn.children( \'img\' ).on( \'load\', function() {\\n            resizeHandler110( \'\\/*opt-uuid-class*\\/\' );\\n        }).each(function() {\\n\\n            \\/\\/ load event won\'t fire if img has already loaded, so this ensures a load event is fired\\n            if( this.complete ) {\\n                $( this ).load();\\n            }\\n        });\\n    } else {\\n        resizeHandler110( \'\\/*opt-uuid-class*\\/\' );\\n    }\\n\\n    $block = $btn = null;\\n\\n} )();\\n\",\"theme\":[],\"userDefinedData\":[{\"id\":\"page-separator-group-1\",\"type\":\"page-separator group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Page Separator\",\"visibility\":\"visible\",\"separator-height\":\"20\",\"top-color\":\"\",\"bottom-color\":\"rgb(53, 72, 84)\",\"auto-color\":{\"topColor\":\"rgb(255, 255, 255)\",\"bottomColor\":\"#cccccc\"}}},{\"id\":\"button-1\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"hidden\",\"alias\":\"Button\",\"html\":\" Click Here to Learn More \",\"href\":null,\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":null,\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\",\"ontraform_id\":\"\"}}],\"visibility\":true,\"direction\":1,\"extraClasses\":false,\"permissionLevel\":\"free\"}],\"settings\":{\"formname\":\"\",\"redirect\":null,\"fillouts\":null,\"unique_visits\":null,\"visits\":null,\"date\":null,\"dlm\":null,\"unique_fillouts\":null,\"object_type_id\":0,\"sort_items\":\"newest\",\"search_items\":{\"search\":\"\"}},\"theme\":{\"theme_font\":{\"children\":{\"h1, ~h1~h1\":{\"attributes\":{\"font-family\":\"\'Playfair Display\', serif\",\"font-size\":\"84px\",\"line-height\":\"82px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"h2, ~h2~h2\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"24px\",\"line-height\":\"32px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"h3, ~h3~h3\":{\"attributes\":{\"font-family\":\"\'Playfair Display\', serif\",\"font-size\":\"40px\",\"line-height\":\"44px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~label~label\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"14px\",\"line-height\":\"14px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"~button~button\":{\"attributes\":{\"font-family\":\"\'Libre Baskerville\', serif\",\"font-size\":\"12px\",\"line-height\":\"14px\",\"font-weight\":\"600\",\"font-style\":\"normal\"}},\"~large-body-text~large-body-text\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"18px\",\"line-height\":\"24px\",\"font-weight\":\"100\",\"font-style\":\"normal\"}},\"~body-text~body-text\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"22px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"blockquote, ~blockquote\":{\"attributes\":{\"font-family\":\"\'Playfair Display\', serif\",\"font-size\":\"18px\",\"line-height\":\"22px\",\"font-weight\":\"100\",\"font-style\":\"italic\"}}}},\"theme_colors\":{\"primary-color\":\"#354854\",\"complimentary-color\":\"#44c5e4\",\"dark-color\":\"#3d3f42\",\"light-color\":\"#e6e6e6\",\"white-color\":\"#ffffff\"},\"theme_background\":{\"id\":\"template-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"#ffffff\",\"options\":[\"backgrounds\"],\"alias\":\"background\"}},\"theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"30px\",\"padding-bottom\":\"30px\"}}}},\"border\":{\"size\":\"5px\",\"color\":\"#fff\"},\"theme_dimensions\":{\"height\":493,\"width\":\"480px\"}},\"templateData\":{\"account_id\":\"0\",\"remote_item_id\":\"0\",\"status\":\"approved\",\"share_type\":\"marketplace\",\"share_subtype\":\"free\",\"purchase_conditions\":\"\",\"featured\":\"0\",\"name\":\"Pasture\",\"price\":\"0.00\",\"type\":\"Landing Page\",\"date\":\"1441416861\",\"date_approved\":\"0\",\"dlm\":\"0\",\"description\":\"Give your customers a hearty thank you with Pasture. The clean layout and vibrant color pallete makes your visitors feel like they\'ve made the right decision shopping with you.\",\"thumbnail\":\"https:\\/\\/app.ontraport.com\\/js\\/ontraport\\/opt_assets\\/templates\\/template_thumbs\\/101_thumbnail.png\",\"resource\":{\"templateId\":101,\"status\":true,\"blocks\":[{\"alias\":\"Client logos\",\"blockId\":\"67\",\"blockTypeId\":17,\"id\":\"d77e11fb-9723-87fc-7fdc-3df1a6bbd764\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/67_client_logos_2\\/\",\"theme\":[],\"userDefinedData\":[{\"id\":\"logo-1_item2\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/landing_page\\/67_client_logos_2\\/..\\/..\\/common\\/stockPhoto\\/ontraport-logo.png\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Logo\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null}},{\"id\":\"item2\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"hidden\"}},{\"id\":\"logo-1_item1\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/101\\/29694.1.b338c705f0caae92362103e0ed253539.PNG\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Logo\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null}},{\"id\":\"item1\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"logo-1_item3\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/landing_page\\/67_client_logos_2\\/..\\/..\\/common\\/stockPhoto\\/ontraport-logo.png\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Logo\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null}},{\"id\":\"item3\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"logo-1_item4\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/landing_page\\/67_client_logos_2\\/..\\/..\\/common\\/stockPhoto\\/ontraport-logo.png\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Logo\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null}},{\"id\":\"item4\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"logo-1_item5\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/landing_page\\/67_client_logos_2\\/..\\/..\\/common\\/stockPhoto\\/ontraport-logo.png\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Logo\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null}},{\"id\":\"item5\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"logo-1_item6\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/landing_page\\/67_client_logos_2\\/..\\/..\\/common\\/stockPhoto\\/ontraport-logo.png\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Logo\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null}},{\"id\":\"item6\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"four-column-container\",\"type\":\"multi-item\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"max\":\"9\",\"min\":\"2\",\"items\":[\"item1\",\"item2\"],\"alias\":\"four column container\",\"visibility\":\"visible\"}}],\"visibility\":true,\"direction\":-1},{\"alias\":\"Banner\",\"blockId\":\"25\",\"blockTypeId\":3,\"id\":\"1ab78bee-3b9d-b1f5-85ac-a8dd21bc153d\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/25_call_to_action_banner\\/\",\"theme\":{\"spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"300px\",\"padding-bottom\":\"300px\"}}}},\"color_variation\":\"option-4\"},\"userDefinedData\":[{\"id\":\"block-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/101\\/29694.1.b99e2343f909e144a37c211d3b87979e.JPEG\",\"options\":false,\"alias\":\"block background\",\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/101\\/29694.1.b99e2343f909e144a37c211d3b87979e.JPEG\"}},{\"id\":\"header-1\",\"type\":\"html\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"html\":\" <span class=\\\"wysiwyg-text-align-center  opt-palette-editor__text-area h1   h1 h1\\\">THANK YOU&nbsp;<\\/span><div><span class=\\\"wysiwyg-text-align-center   opt-palette-editor__text-area h1   h1 h1\\\">FOR YOUR DONATION!<\\/span><\\/div>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Header\"}},{\"id\":\"subHeader-1\",\"type\":\"html\",\"for\":null,\"tag\":\"H2\",\"attrs\":{\"html\":\"<div><span class=\\\"wysiwyg-text-align-center\\\"><br><\\/span><\\/div><span class=\\\"wysiwyg-text-align-center\\\">Your contribution will help us spread food around the world to those in need.&nbsp;<\\/span><div><span class=\\\"wysiwyg-text-align-center\\\">Thank you for your support. A receipt has been sent to your inbox.<\\/span><br><\\/div>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Sub-Header\"}},{\"id\":\"button-1\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"hidden\",\"alias\":\"Button\",\"html\":\"SIGN ME UP\",\"href\":\"javascript:\\/\\/\",\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":null,\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\"}}],\"visibility\":true,\"direction\":-1},{\"alias\":\"Text\",\"blockId\":\"141\",\"blockTypeId\":2,\"id\":\"b27e5109-78f9-2749-f8a6-4622b3041703\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/141_image_and_text_with_buttons_2\\/\",\"scripts\":\" \\/*block scripts*\\/\",\"theme\":[],\"userDefinedData\":[{\"id\":\"img-1\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/101\\/29694.1.742a9c62abe1c998549a307c54302bbe.JPEG\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Image\",\"aviary-options\":null,\"fixed-width-default\":false}},{\"id\":\"header-1\",\"type\":\"html\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"html\":\"<span class=\\\"  opt-palette-editor__text-area h3   h3 h3\\\">FEED THE WORLD<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Header\"}},{\"id\":\"bodyText-1\",\"type\":\"html\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"html\":\"<span class=\\\"  opt-palette-editor__text-area  body-text body-text\\\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor.<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Body Text\"}},{\"id\":\"button-2\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"hidden\",\"alias\":\"Second Button\",\"html\":\"Feed the children.\",\"href\":null,\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":\"\\/js\\/ontraport\\/components\\/opt_palette_editor\\/image\\/views\\/noslide.png\",\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\"}},{\"id\":\"button-1\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"Button\",\"html\":\"<span class=\\\"button\\\">LEARN MORE<\\/span>\",\"href\":null,\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":\"\\/js\\/ontraport\\/components\\/opt_palette_editor\\/image\\/views\\/noslide.png\",\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\",\"img_href\":null,\"img_target\":\"_self\",\"img_page_select\":null,\"img_file_name\":null,\"img_url_type\":null,\"fixed-width-default\":false}}],\"visibility\":true,\"direction\":-1},{\"alias\":\"Divider\",\"blockId\":\"121\",\"blockTypeId\":19,\"id\":\"c94c798c-b989-504e-088f-dd8aefa69a46\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/121_divider_with_line\\/\",\"theme\":[],\"userDefinedData\":[{\"id\":\"page-separator-group-1\",\"type\":\"page-separator group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Page Separator\",\"visibility\":\"visible\",\"separator-height\":\"50\",\"top-color\":\"rgb(255, 255, 255)\",\"bottom-color\":\"rgb(255, 255, 255)\",\"auto-color\":{\"topColor\":\"rgb(255, 255, 255)\",\"bottomColor\":\"rgb(255, 255, 255)\"}}},{\"id\":\"block-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"\",\"bgImage\":\"\",\"options\":false,\"alias\":\"block background\"}},{\"id\":\"text-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"\",\"bgImage\":\"\",\"options\":false,\"alias\":\"text background\"}},{\"id\":\"bodyText-1\",\"type\":\"html\",\"for\":null,\"tag\":\"P\",\"attrs\":{\"html\":\"x\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Body Text\"}},{\"id\":\"img-1\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/101\\/29694.1.64d7db8b458f961ba1d5ee592a089b66.PNG\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Image\"}}],\"visibility\":true,\"direction\":-1},{\"alias\":\"Text\",\"blockId\":\"141\",\"blockTypeId\":2,\"id\":\"7164212f-3b64-e619-c514-65e59c9e9bec\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/141_image_and_text_with_buttons_2\\/\",\"scripts\":\" \\/*block scripts*\\/\",\"theme\":[],\"userDefinedData\":[{\"id\":\"img-1\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/101\\/29694.1.ecbcad300d651d979d6ceae9e54c0e77.JPEG\",\"options\":false,\"visibility\":\"visible\",\"alias\":\"Image\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null,\"aviary-options\":null}},{\"id\":\"header-1\",\"type\":\"html\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"html\":\"<span class=\\\"  opt-palette-editor__text-area h3   h3 h3\\\">SPREAD THE LOVE<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Header\"}},{\"id\":\"bodyText-1\",\"type\":\"html\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"html\":\"<span class=\\\"  opt-palette-editor__text-area  body-text body-text\\\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate.<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"Body Text\"}},{\"id\":\"button-1\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"Button\",\"html\":\"<span class=\\\"button\\\">LEARN MORE<\\/span>\",\"href\":null,\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":\"\\/js\\/ontraport\\/components\\/opt_palette_editor\\/image\\/views\\/noslide.png\",\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\",\"img_href\":null,\"img_target\":\"_self\",\"img_page_select\":null,\"img_file_name\":null,\"img_url_type\":null,\"fixed-width-default\":false}},{\"id\":\"button-2\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"hidden\",\"alias\":\"Second Button\",\"html\":\"<span class=\\\"button\\\">Schedule Consultation<\\/span>\",\"href\":null,\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":null,\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\"}}],\"visibility\":true,\"direction\":1},{\"alias\":\"Divider\",\"blockId\":\"51\",\"blockTypeId\":19,\"id\":\"db4bf46d-112a-1f4b-f8f3-73050ea3fbaf\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/51_page_separator\\/\",\"theme\":[],\"userDefinedData\":[{\"id\":\"page-separator-group-1\",\"type\":\"page-separator group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Page Separator\",\"visibility\":\"visible\",\"separator-height\":\"50\",\"top-color\":\"\",\"bottom-color\":\"\",\"auto-color\":{\"topColor\":\"rgb(255, 255, 255)\",\"bottomColor\":\"rgb(230, 230, 230)\"}}}],\"visibility\":true},{\"alias\":\"Social sharing\",\"blockId\":\"29\",\"blockTypeId\":13,\"id\":\"9fcb2cdf-6dc8-e848-9d23-56f16cc9cc49\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/29_social_links\\/\",\"theme\":{\"color_variation\":\"option-2\",\"spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"10px\",\"padding-bottom\":\"30px\"}}}}},\"userDefinedData\":[{\"id\":\"block-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"\",\"options\":false,\"alias\":\"block background\",\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/noslide.png\"}},{\"id\":\"social-link-1\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 1\",\"href\":\"javascript:\\/\\/\",\"target\":\"_self\",\"data-social-flavor\":\"facebook\"}},{\"id\":\"social-1\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Facebook\",\"visibility\":\"visible\"}},{\"id\":\"social-link-2\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 2\",\"href\":\"javascript:\\/\\/\",\"target\":\"_self\",\"data-social-flavor\":\"twitter\"}},{\"id\":\"social-2\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"Twitter\",\"visibility\":\"visible\"}},{\"id\":\"social-link-3\",\"type\":\"social-link\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"social link 3\",\"href\":\"javascript:\\/\\/\",\"target\":\"_self\",\"data-social-flavor\":\"linkedin\"}},{\"id\":\"social-3\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"LinkedIn\",\"visibility\":\"visible\"}},{\"id\":\"social-sharing-1\",\"type\":\"social-sharing group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"visibility\":\"visible\",\"alias\":\"Social Sharing\",\"data-current-iconset\":\"monochromatic\",\"social-flavor-order\":\"social-1,social-2,social-3\",\"social-iconsize\":\"72px\",\"data-social-iconsize-responsive\":null,\"min\":1,\"max\":12}}],\"visibility\":true},{\"alias\":\"Header\",\"blockId\":\"82\",\"blockTypeId\":15,\"id\":\"12d6d736-4262-8d51-f111-622e0616bc77\",\"path\":\"\\/js\\/ontraport\\/opt_assets\\/blocks\\/landing_page\\/82_header_nav_signup_or_login\\/\",\"theme\":{\"color_variation\":\"option-4\"},\"userDefinedData\":[{\"id\":\"logo-1\",\"type\":\"image\",\"for\":null,\"tag\":\"IMG\",\"attrs\":{\"src\":\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/landing_page\\/82_header_nav_signup_or_login\\/..\\/..\\/common\\/stockPhoto\\/ontraport-logo.png\",\"options\":false,\"visibility\":\"hidden\",\"alias\":\"Logo\",\"img_href\":null,\"img_target\":null,\"img_file_name\":null,\"img_page_select\":null,\"img_url_type\":null}},{\"id\":\"button-1\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"hidden\",\"alias\":\"Sign Up Button\",\"html\":\"<b>Sign Up<\\/b>\",\"href\":\"javascript:\\/\\/\",\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":null,\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\"}},{\"id\":\"button-2\",\"type\":\"button\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"visibility\":\"hidden\",\"alias\":\" Log In Button\",\"html\":\"<b> Log In <\\/b>\",\"href\":\"javascript:\\/\\/\",\"target\":\"_self\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"src\":null,\"link_background\":\"\",\"hover_bg\":\"\",\"hover_text\":\"\"}},{\"id\":\"link-text-1_item1\",\"type\":\"html\",\"for\":null,\"tag\":\"SPAN\",\"attrs\":{\"html\":\"<span class=\\\"  opt-palette-editor__text-area  body-text body-text\\\">Blog<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"link text 1_item1\"}},{\"id\":\"link-1_item1\",\"type\":\"link group\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"href\":null,\"target\":\"_self\",\"visibility\":\"visible\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"alias\":\"Link\"}},{\"id\":\"item1\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"link-text-1_item2\",\"type\":\"html\",\"for\":null,\"tag\":\"SPAN\",\"attrs\":{\"html\":\"<span class=\\\" opt-palette-editor__text-area  body-text body-text\\\">Projects<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"link text 1_item2\"}},{\"id\":\"link-1_item2\",\"type\":\"link group\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"href\":null,\"target\":\"_self\",\"visibility\":\"visible\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"alias\":\"Link\"}},{\"id\":\"item2\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"link-text-1_item3\",\"type\":\"html\",\"for\":null,\"tag\":\"SPAN\",\"attrs\":{\"html\":\"<span class=\\\" opt-palette-editor__text-area  body-text body-text\\\">Features<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"link text 1_item3\"}},{\"id\":\"link-1_item3\",\"type\":\"link group\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"href\":null,\"target\":\"_self\",\"visibility\":\"visible\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"alias\":\"Link\"}},{\"id\":\"item3\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"link-text-1_item4\",\"type\":\"html\",\"for\":null,\"tag\":\"SPAN\",\"attrs\":{\"html\":\"<span class=\\\" opt-palette-editor__text-area  body-text body-text\\\">Support<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"link text 1_item4\"}},{\"id\":\"link-1_item4\",\"type\":\"link group\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"href\":null,\"target\":\"_self\",\"visibility\":\"visible\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"alias\":\"Link\"}},{\"id\":\"item4\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"link-text-1_item5\",\"type\":\"html\",\"for\":null,\"tag\":\"SPAN\",\"attrs\":{\"html\":\"<span class=\\\" opt-palette-editor__text-area  body-text body-text\\\">Pricing<\\/span>\",\"visibility\":\"visible\",\"options\":false,\"help\":false,\"alias\":\"link text 1_item5\"}},{\"id\":\"link-1_item5\",\"type\":\"link group\",\"for\":null,\"tag\":\"A\",\"attrs\":{\"href\":null,\"target\":\"_self\",\"visibility\":\"visible\",\"file_name\":null,\"page_select\":null,\"url_type\":null,\"alias\":\"Link\"}},{\"id\":\"item5\",\"type\":\"group\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"alias\":\"item\",\"visibility\":\"visible\"}},{\"id\":\"header-container\",\"type\":\"multi-item\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"max\":\"6\",\"min\":\"1\",\"items\":[\"item1\",\"item2\",\"item3\",\"item4\",\"item5\"],\"alias\":\"Menu Items\",\"visibility\":\"visible\"}}],\"visibility\":true}],\"settings\":{\"domain\":null,\"visits\":null,\"conversions\":null,\"design_type\":null,\"listFields\":null,\"listFieldSettings\":null,\"count\":null,\"lpsent\":null,\"lpconvert\":null,\"id\":null,\"uri_id\":null,\"rotation\":null,\"last_save\":null,\"last_auto\":null,\"autosave\":null,\"visits_0\":null,\"visits_1\":null,\"visits_2\":null,\"visits_3\":null,\"platform\":null,\"ssl_enabled\":null,\"type\":\"landing_page\",\"blocks\":null,\"block_type_id\":null,\"a_sent\":null,\"a_convert\":null,\"b_sent\":null,\"b_convert\":null,\"c_sent\":null,\"c_convert\":null,\"d_sent\":null,\"d_convert\":null,\"object_type_id\":null,\"opt_in_settings\":\"single\",\"conditionsCustomUrl\":\"\",\"conditionsRedirectRadioButtons\":\"default\",\"form_contacts_thank_you_page_redir\":\"0\",\"singleCustomUrl\":\"\",\"thankYouRedirectRadioButtons\":\"default\",\"page_title\":\"\",\"meta_description\":\"\",\"header_custom_script\":\"\",\"footer_custom_script\":\"\",\"favicon_uploader\":\"\\/\\/app.ontraport.com\\/favicon.ico\",\"tags\":[],\"sequences\":[],\"rules_default\":[],\"rules_transaction_fail\":[],\"notif\":\"\",\"cookie_overide\":\"0\",\"cgi\":\"0\",\"owner\":\"\",\"opt_canvas\":[],\"opt_palette\":[]},\"theme\":{\"theme_font\":{\"children\":{\"h1, ~h1~h1\":{\"attributes\":{\"font-family\":\"\'Playfair Display\', serif\",\"font-size\":\"84px\",\"line-height\":\"82px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"h2, ~h2~h2\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"24px\",\"line-height\":\"32px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"h3, ~h3~h3\":{\"attributes\":{\"font-family\":\"\'Playfair Display\', serif\",\"font-size\":\"40px\",\"line-height\":\"44px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~label~label\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"14px\",\"line-height\":\"14px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"~button~button\":{\"attributes\":{\"font-family\":\"\'Libre Baskerville\', serif\",\"font-size\":\"12px\",\"line-height\":\"14px\",\"font-weight\":\"600\",\"font-style\":\"normal\"}},\"~large-body-text~large-body-text\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"18px\",\"line-height\":\"24px\",\"font-weight\":\"100\",\"font-style\":\"normal\"}},\"~body-text~body-text\":{\"attributes\":{\"font-family\":\"\'Lato\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"22px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"blockquote, ~blockquote\":{\"attributes\":{\"font-family\":\"\'Playfair Display\', serif\",\"font-size\":\"18px\",\"line-height\":\"22px\",\"font-weight\":\"100\",\"font-style\":\"italic\"}}}},\"theme_colors\":{\"primary-color\":\"#44c5e4\",\"complimentary-color\":\"#ed9523\",\"dark-color\":\"#3d3f42\",\"light-color\":\"#e6e6e6\",\"white-color\":\"#ffffff\"},\"theme_background\":{\"id\":\"template-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"#ffffff\",\"options\":[\"backgrounds\"],\"alias\":\"background\"}},\"theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"30px\",\"padding-bottom\":\"30px\"}}}}}},\"industries\":null,\"types\":\"thank-you-pages\",\"tags\":null,\"opt_template_categories\":\" thank-you-pages free\",\"id\":\"101\",\"displayObjectNotFoundErrors\":true},\"version\":\"v2\",\"mergedData\":\"<!DOCTYPE html><html><head> <!-- This page was built using ONTRApages. Create and host your pages free at ONTRApages.com or learn more about the most powerful business and marketing automation platform designed for entrepreneurs at ONTRAPORT.com --> <meta charset=\\\"utf-8\\\"> <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\"> <link rel=\\\"stylesheet\\\" href=\\\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/skeleton\\/css\\/normalize.css\\\"> <link rel=\\\"stylesheet\\\" href=\\\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/skeleton\\/css\\/skeleton.css\\\"> <link rel=\\\"stylesheet\\\" href=\\\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/skeleton\\/css\\/skeleton.ontraport.css\\\"> <link rel=\\\"stylesheet\\\" href=\\\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/skeleton\\/css\\/fonts.css\\\"> <link rel=\\\"stylesheet\\\" href=\\\"\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/css\\/wysihtml5-textalign.css\\\"> <!--OPT-CUSTOM-HEADER-SCRIPT--><style class=\\\"theme-style\\\">h1, .h1.h1 { font-family: \'Playfair Display\', serif; font-size: 84px; line-height: 82px; font-weight: 700; font-style: normal; text-decoration: inherit;}h2, .h2.h2 { font-family: \'Lato\', sans-serif; font-size: 24px; line-height: 32px; font-weight: 300; font-style: normal; text-decoration: inherit;}h3, .h3.h3 { font-family: \'Playfair Display\', serif; font-size: 40px; line-height: 44px; font-weight: 700; font-style: normal; text-decoration: inherit;}.label.label { font-family: \'Lato\', sans-serif; font-size: 14px; line-height: 14px; font-weight: 300; font-style: normal; text-decoration: inherit;}.button.button { font-family: \'Libre Baskerville\', serif; font-size: 12px; line-height: 14px; font-weight: 600; font-style: normal; text-decoration: inherit;}.large-body-text.large-body-text { font-family: \'Lato\', sans-serif; font-size: 18px; line-height: 24px; font-weight: 100; font-style: normal; text-decoration: inherit;}.body-text.body-text { font-family: \'Lato\', sans-serif; font-size: 16px; line-height: 22px; font-weight: 300; font-style: normal; text-decoration: inherit;}blockquote, .blockquote { font-family: \'Playfair Display\', serif; font-size: 18px; line-height: 22px; font-weight: 100; font-style: italic; text-decoration: inherit;}.au.au.au { color: #3d3f42;}.v.v.v { color: #ffffff;}.ad.ad.ad { background-color: #ffffff;}.k.k.k { background-color: #3d3f42;}.am.am.am, .am.am.am a { color: #ffffff; background-color: #354854;}.o.o.o, .o.o.o a { color: #354854; background-color: #ffffff;}.ar.ar.ar { background-color: #e6e6e6;}.an.an.an { border-color: #3d3f42;}.ag.ag { color: #3d3f42;}.ag.ag.ag:hover { color: #354854;}.as.as.as { color: #354854;}.as.as.as:hover { color: #3d3f42;}hr.aw.aw.aw, span.aw.aw.aw, h1.aw.aw.aw, h2.aw.aw.aw, h3.aw.aw.aw, p.aw.aw.aw, .ak.ak.ak { color: #354854;}hr.aw.aw.aw, table.aw.aw.aw, div.aw.aw.aw, a.aw.aw.aw, .t.t.t { background-color: #354854;}hr.aw.aw.aw, img.aw.aw.aw, a.aw.aw.aw, div.aw.aw.aw, .ac.ac.ac { border-color: #354854;}hr.af.af.af, span.af.af.af, h1.af.af.af, h2.af.af.af, h3.af.af.af, p.af.af.af, .u.u.u { color: #44c5e4;}hr.af.af.af, table.af.af.af, div.af.af.af, a.af.af.af, .j.j.j { background-color: #44c5e4;}hr.af.af.af, img.af.af.af, a.af.af.af, div.af.af.af, .p.p.p { border-color: #44c5e4;}hr.az.az.az, span.az.az.az, h1.az.az.az, h2.az.az.az, h3.az.az.az, p.az.az.az, .aq.aq.aq { color: #3d3f42;}hr.az.az.az, table.az.az.az, div.az.az.az, a.az.az.az, .ab.ab.ab { background-color: #3d3f42;}hr.az.az.az, img.az.az.az, a.az.az.az, div.az.az.az, .al.al.al { border-color: #3d3f42;}hr.ax.ax.ax, span.ax.ax.ax, h1.ax.ax.ax, h2.ax.ax.ax, h3.ax.ax.ax, p.ax.ax.ax, .ao.ao.ao { color: #e6e6e6;}hr.ax.ax.ax, table.ax.ax.ax, div.ax.ax.ax, a.ax.ax.ax, .z.z.z { background-color: #e6e6e6;}hr.ax.ax.ax, img.ax.ax.ax, a.ax.ax.ax, div.ax.ax.ax, .aj.aj.aj { border-color: #e6e6e6;}hr.ay.ay.ay, span.ay.ay.ay, h1.ay.ay.ay, h2.ay.ay.ay, h3.ay.ay.ay, p.ay.ay.ay, .ap.ap.ap { color: #ffffff;}hr.ay.ay.ay, table.ay.ay.ay, div.ay.ay.ay, a.ay.ay.ay, .x.x.x { background-color: #ffffff;}hr.ay.ay.ay, img.ay.ay.ay, a.ay.ay.ay, div.ay.ay.ay, .ai.ai.ai { border-color: #ffffff;}a { color: #354854; text-decoration: none;}a:hover { text-decoration: underline;}.spacing { padding-top: 30px; padding-bottom: 30px;}<\\/style><style class=\\\"block-theme-css\\\">.c .spacing { padding-top: 50px; padding-bottom: 0px;}.c .au.au.au { color: #ffffff;}.c .v.v.v { color: #354854;}.c .ad.ad.ad { background-color: #354854;}.c .k.k.k { background-color: #ffffff;}.c .am.am.am,.c .am.am.am a { color: #354854; background-color: #ffffff;}.c .o.o.o,.c .o.o.o a { color: #ffffff; background-color: #354854;}.c .ar.ar.ar { background-color: #ffffff;}.c .an.an.an { border-color: #ffffff;}.c .ag.ag.ag { color: #ffffff;}.c .ag.ag.ag:hover { color: #3d3f42;}.c .as.as.as { color: #ffffff;}.c .as.as.as:hover { color: #3d3f42;}.c hr.aw.aw.aw,.c span.aw.aw.aw,.c h1.aw.aw.aw,.c h2.aw.aw.aw,.c h3.aw.aw.aw,.c p.aw.aw.aw,.c .ak.ak.ak { color: #e6e6e6;}.c hr.aw.aw.aw,.c table.aw.aw.aw,.c div.aw.aw.aw,.c a.aw.aw.aw,.c .t.t.t { background-color: #e6e6e6;}.c hr.aw.aw.aw,.c img.aw.aw.aw,.c a.aw.aw.aw,.c div.aw.aw.aw,.c .ac.ac.ac { border-color: #e6e6e6;}.c hr.ae.ae.ae,.c span.ae.ae.ae,.c h1.ae.ae.ae,.c h2.ae.ae.ae,.c h3.ae.ae.ae,.c p.ae.ae.ae,.c .s.s.s { color: undefined;}.c hr.ae.ae.ae,.c table.ae.ae.ae,.c div.ae.ae.ae,.c a.ae.ae.ae,.c .m.m.m { background-color: undefined;}.c hr.ae.ae.ae,.c img.ae.ae.ae,.c a.ae.ae.ae,.c div.ae.ae.ae,.c .q.q.q { border-color: undefined;}.c hr.az.az.az,.c span.az.az.az,.c h1.az.az.az,.c h2.az.az.az,.c h3.az.az.az,.c p.az.az.az,.c .aq.aq.aq { color: #ffffff;}.c hr.az.az.az,.c table.az.az.az,.c div.az.az.az,.c a.az.az.az,.c .ab.ab.ab { background-color: #ffffff;}.c hr.az.az.az,.c img.az.az.az,.c a.az.az.az,.c div.az.az.az,.c .al.al.al { border-color: #ffffff;}.c hr.ax.ax.ax,.c span.ax.ax.ax,.c h1.ax.ax.ax,.c h2.ax.ax.ax,.c h3.ax.ax.ax,.c p.ax.ax.ax,.c .ao.ao.ao { color: #e6e6e6;}.c hr.ax.ax.ax,.c table.ax.ax.ax,.c div.ax.ax.ax,.c a.ax.ax.ax,.c .z.z.z { background-color: #e6e6e6;}.c hr.ax.ax.ax,.c img.ax.ax.ax,.c a.ax.ax.ax,.c div.ax.ax.ax,.c .aj.aj.aj { border-color: #e6e6e6;}.c hr.ay.ay.ay,.c span.ay.ay.ay,.c h1.ay.ay.ay,.c h2.ay.ay.ay,.c h3.ay.ay.ay,.c p.ay.ay.ay,.c .ap.ap.ap { color: #354854;}.c hr.ay.ay.ay,.c table.ay.ay.ay,.c div.ay.ay.ay,.c a.ay.ay.ay,.c .x.x.x { background-color: #354854;}.c hr.ay.ay.ay,.c img.ay.ay.ay,.c a.ay.ay.ay,.c div.ay.ay.ay,.c .ai.ai.ai { border-color: #354854;}.c a { color: #354854; text-decoration: none;}.c a:hover { text-decoration: underline;}.b .spacing { padding-top: 20px; padding-bottom: 0px;}<\\/style><link rel=\\\"dns-prefetch\\\" href=\\\"https:\\/\\/optassets.ontraport.com\\\"><link rel=\\\"dns-prefetch\\\" href=\\\"\\/\\/ajax.googleapis.com\\\"><link rel=\\\"dns-prefetch\\\" href=\\\"\\/\\/app.ontraport.com\\\"><link rel=\\\"dns-prefetch\\\" href=\\\"\\/\\/optassets.ontraport.com\\\"><link rel=\\\"dns-prefetch\\\" href=\\\"https:\\/\\/forms.ontraport.com\\\"><\\/head><body> <div class=\\\"opt-container\\\" opt-id=\\\"template-background\\\" opt-type=\\\"background\\\" style=\\\"background-color: rgb(255, 255, 255); background-image: none;\\\" opt-options=\\\"[&quot;backgrounds&quot;]\\\" opt-alias=\\\"background\\\"><div><div class=\\\"row c opt-page-size-mobile\\\" opt-id=\\\"1ab78bee-3b9d-b1f5-85ac-a8dd21bc153d\\\" opt-type=\\\"block\\\" opt-block-type-id=\\\"3\\\" opt-block-style-id=\\\"25\\\" data-original-classes=\\\"row c\\\"><div class=\\\"block-style\\\"><style class=\\\"block-css\\\">\\/*block styles*\\/ .at { background-repeat: no-repeat; background-position: center center;} .y { margin-bottom: 20px;} .r { margin-bottom: 50px;}<\\/style> <div class=\\\"block-wrapper ad at spacing\\\" style=\\\"background-size: cover; background-position: center center; background-image: url(&quot;\\/js\\/ontraport\\/opt_assets\\/blocks\\/common\\/stockPhoto\\/blocks\\/block25\\/office-tint-2guys.jpg&quot;);\\\"> <div class=\\\"container body-text\\\"> <div aria-description=\\\"Call To Action Banner\\\"> <div class=\\\"y au\\\"><span class=\\\"wysiwyg-text-align-center h3\\\">Big things start small.<\\/span><\\/div> <div class=\\\"r au\\\"><div><span class=\\\"wysiwyg-text-align-center\\\">One year ago we opened the doors to our business.<\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\">&nbsp;<\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\">Since then we have been lucky enough to have incredible clients like you passing on the good word about us.&nbsp;<\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\"><br><\\/span><\\/div><div><span class=\\\"wysiwyg-text-align-center\\\">Please consider sharing this page with your friends &amp; in doing so helping us accomplish our \'big\' goals!<\\/span><\\/div><\\/div> <\\/div> <\\/div><\\/div> <\\/div><\\/div><div class=\\\"row b opt-page-size-mobile\\\" opt-id=\\\"9fcb2cdf-6dc8-e848-9d23-56f16cc9cc49\\\" opt-type=\\\"block\\\" opt-block-type-id=\\\"13\\\" opt-block-style-id=\\\"29\\\" data-original-classes=\\\"row b\\\"><div class=\\\"block-style\\\"><style class=\\\"block-css\\\">\\/*block styles*\\/ .h { text-align: center;} .av { display: inline-block;} .av { margin: 0 10px;}<\\/style> <div class=\\\"block-wrapper block-style-29 spacing ad\\\"> <div class=\\\"container\\\"> <div aria-description=\\\"Social Sharing Links\\\"> <div data-current-iconset=\\\"color-icons\\\" social-iconsize=\\\"48px\\\" class=\\\"h\\\" av-order=\\\"social-1,social-2,social-3,social-70e7c343-57d9-4af6-91df-bc7106afed0a,social-86b7edd4-4e27-8030-4a20-bd04641ce008,social-8efa090e-df5a-9729-6710-d276cf0e05ea\\\"> <div class=\\\"av\\\"> <a href=\\\"javascript:\\/\\/\\\" data-iconset=\\\"color-icons\\\" data-iconsize=\\\"48px\\\" target=\\\"_self\\\" data-av=\\\"facebook\\\"> <img src=\\\"https:\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/iconsets\\/color-icons\\/facebook.png\\\" style=\\\";width:48px !important;\\\" width=\\\"48\\\"> <\\/a> <\\/div><div class=\\\"av\\\"> <a href=\\\"javascript:\\/\\/\\\" data-iconset=\\\"color-icons\\\" data-iconsize=\\\"48px\\\" target=\\\"_self\\\" data-av=\\\"twitter\\\"> <img src=\\\"https:\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/iconsets\\/color-icons\\/twitter.png\\\" style=\\\";width:48px !important;\\\" width=\\\"48\\\"> <\\/a> <\\/div><div class=\\\"av\\\"> <a href=\\\"javascript:\\/\\/\\\" data-iconset=\\\"color-icons\\\" data-iconsize=\\\"48px\\\" target=\\\"_self\\\" data-av=\\\"linkedin\\\"> <img src=\\\"https:\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/iconsets\\/color-icons\\/linkedin.png\\\" style=\\\";width:48px !important;\\\" width=\\\"48\\\"> <\\/a> <\\/div><div class=\\\"av\\\"> <a href=\\\"javascript:\\/\\/\\\" data-av=\\\"googleplus\\\" data-iconset=\\\"color-icons\\\" data-iconsize=\\\"48px\\\" target=\\\"_self\\\"> <img src=\\\"https:\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/iconsets\\/color-icons\\/googleplus.png\\\" style=\\\";width:48px !important;\\\" width=\\\"48\\\"> <\\/a> <\\/div><div class=\\\"av\\\"> <a href=\\\"javascript:\\/\\/\\\" data-av=\\\"instagram\\\" data-iconset=\\\"color-icons\\\" data-iconsize=\\\"48px\\\" target=\\\"_self\\\"> <img src=\\\"https:\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/iconsets\\/color-icons\\/instagram.png\\\" style=\\\";width:48px !important;\\\" width=\\\"48\\\"> <\\/a> <\\/div><div class=\\\"av\\\"> <a href=\\\"javascript:\\/\\/\\\" data-av=\\\"pinterest\\\" data-iconset=\\\"color-icons\\\" data-iconsize=\\\"48px\\\" target=\\\"_self\\\"> <img src=\\\"https:\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/iconsets\\/color-icons\\/pinterest.png\\\" style=\\\";width:48px !important;\\\" width=\\\"48\\\"> <\\/a> <\\/div><\\/div> <\\/div> <\\/div><\\/div> <\\/div><\\/div><div class=\\\"row a\\\" opt-id=\\\"3b5a309e-2838-a570-c130-502336307eac\\\" opt-type=\\\"block\\\" opt-block-type-id=\\\"19\\\" opt-block-style-id=\\\"110\\\"><style class=\\\"opt-page-separator-color-3b5a309e-2838-a570-c130-502336307eac\\\">.a .ah { background-color: rgb(255, 255, 255) }.a .n { border-top-color: rgb(255, 255, 255) }.a .aa { background-color: #cccccc }<\\/style><div class=\\\"block-style\\\"><style class=\\\"block-css\\\">.l { \\/* Override block-wrapper so page separator goes to the very edge of the block *\\/ padding-top: 0; padding-bottom: 0; position: relative;} .e.d { position: relative; width: 100%;} .w { position: absolute; top: 50%; left: 0; display: inline-block;} .g { position: relative;} .f { padding-bottom: 0 !important; } .i { padding-top: 0 !important; }<\\/style> <div class=\\\"block-wrapper block-style-110 l opt-center\\\"> <div aria-description=\\\"Page Separator\\\" class=\\\"block-style-110__page-separator__wrapper a\\\" separator-height=\\\"20\\\" top-color=\\\"#fff\\\" bottom-color=\\\"#ccc\\\"> <div class=\\\"ah e spacing f\\\" style=\\\"height: 20px;\\\"> <\\/div> <div class=\\\"g\\\"> <\\/div> <div class=\\\"aa d spacing i\\\" style=\\\"height: 20px; background-color: rgb(53, 72, 84);\\\"> <\\/div> <\\/div><\\/div> <script class=\\\"common-script\\\" type=\\\"javascript\\\" href=\\\"..\\/common\\/jQueryPageBackgroundPro\\/jQueryPageBackgroundPro.min.js\\\"><\\/script> <\\/div><\\/div><\\/div> <!--OPT-AD-BLOCK-HERE--> <\\/div> <script src=\\\"\\/\\/ajax.googleapis.com\\/ajax\\/libs\\/jquery\\/1.7.1\\/jquery.min.js\\\"><\\/script> <script class=\\\"opt-page-script\\\" type=\\\"text\\/javascript\\\" src=\\\"https:\\/\\/optassets.ontraport.com\\/opt_assets\\/blocks\\/common\\/jQueryPageBackgroundPro\\/js\\/libs\\/underscore.js\\\"><\\/script> <script src=\\\"\\/\\/app.ontraport.com\\/js\\/globalize\\/globalize.js\\\"><\\/script> <span style=\\\"display: none;\\\">[bot_catcher]<\\/span> <!--OPT-CUSTOM-FOOTER-SCRIPT--><script> ;( function(){ function resizeHandler110( block110Uid ) { var $block = $( block110Uid ), $btn = $block.find( \'.w\' ), topPadding = parseInt( $block.find( \'.e\' ).css( \'padding-top\' ) ), bottomPadding = parseInt( $block.find( \'.d\' ).css( \'padding-bottom\' ) ), paddingDiff = topPadding - bottomPadding, width = $btn.outerWidth(), height = $btn.outerHeight(), marginTop = ( paddingDiff - height )\\/2; $btn.css( { \\\"marginLeft\\\": \\\"-\\\" + ( width \\/ 2 ) + \\\"px\\\", \\\"marginTop\\\": marginTop + \\\"px\\\", \\\"left\\\": \\\"50%\\\" } ); $block = $btn = null; } $( window ).on( \\\"resize\\\", _.throttle( function(){ resizeHandler110( \'.a\' ); }, 500 ) ); var $block = $( \'.a\' ), $btn = $block.find( \'.w\' ); if ( $btn.hasClass( \'opt-image-button\' ) ) { $btn.children( \'img\' ).on( \'load\', function() { resizeHandler110( \'.a\' ); }).each(function() { if( this.complete ) { $( this ).load(); } }); } else { resizeHandler110( \'.a\' ); } $block = $btn = null; } )();<\\/script><script type=\'text\\/javascript\' src=\'[ontraforms_hostname]\\/js\\/ontraport\\/opt_assets\\/drivers\\/opf.js\' async=\'true\'><\\/script><\\/body><\\/html>\",\"formBlockIds\":[]},{\"templateId\":false,\"status\":false,\"blocks\":[],\"settings\":{\"favicon_uploader\":\"\\/\\/app.ontraport.com\\/favicon.png\",\"globalFormStyles\":{\"input_style\":\"default\",\"input_label_color\":\"#9e9e9e\",\"input_label_color_focus\":\"primary-color\",\"input_label_background_color\":\"transparent\",\"input_label_background_color_focus\":\"transparent\",\"input_label_font_style\":\"label\",\"input_label_position\":\"top\",\"input_label_width\":40,\"input_label_alignment\":\"left\",\"input_label_padding_top\":0,\"input_label_padding_bottom\":5,\"input_label_padding_right\":2,\"input_label_padding_left\":2,\"input_text_color\":\"dark-color\",\"input_text_color_hover\":\"dark-color\",\"input_bg_color\":\"white-color\",\"input_bg_color_hover\":\"white-color\",\"input_bg_color_focus\":\"white-color\",\"input_line_color\":\"#b9b9b9\",\"input_line_color_focus\":\"primary-color\",\"input_font_style\":\"body-text\",\"input_alignment\":\"left\",\"input_padding_top\":0,\"input_padding_bottom\":0,\"input_padding_left\":0,\"input_padding_right\":0,\"input_border\":[{\"attrs\":[],\"settings\":{\"border-position\":\"all\",\"border-style\":\"solid\",\"border-width\":\"1px\",\"border-color\":\"#b9b9b9\",\"border-color-hover\":\"#b9b9b9\",\"border-color-focus\":\"#b9b9b9\"}}],\"input_textarea_height\":\"3\",\"input_checkbox_border_color\":\"dark-color\",\"input_checkbox_checkmark_color\":\"primary-color\",\"input_checkbox_background_color\":\"dark-color\",\"input_checkbox_label_position\":\"right\",\"input_checkbox_margin_top\":0,\"input_dropdown_bg_color\":\"white-color\",\"input_dropdown_bg_color_hover\":\"light-color\",\"input_dropdown_bg_color_selected\":\"primary-color\",\"input_dropdown_color\":\"dark-color\",\"input_dropdown_color_hover\":\"dark-color\",\"input_dropdown_color_selected\":\"white-color\",\"input_dropdown_font_style\":\"body-text\",\"input_dropdown_border\":[{\"attrs\":[],\"settings\":{\"border-position\":\"all\",\"border-style\":\"none\",\"border-width\":\"1px\",\"border-color\":\"dark-color\",\"border-color-hover\":\"dark-color\"}}],\"input_icon_display\":\"none\",\"icon_size\":32,\"icon_color\":\"dark-color\",\"icon\":\"settings\",\"icon_type\":\"google\",\"input_label_line_height\":16,\"input_line_height\":22}},\"theme\":{\"theme_font\":{\"children\":{\"h1, ~h1~h1\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"60px\",\"line-height\":\"60px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"h2, ~h2~h2\":{\"attributes\":{\"font-family\":\"\'Work Sans\', sans-serif\",\"font-size\":\"36px\",\"line-height\":\"32px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"h3, ~h3~h3\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"20px\",\"line-height\":\"24px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~label~label\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"14px\",\"line-height\":\"14px\",\"font-weight\":\"500\",\"font-style\":\"normal\"}},\"~button~button\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"16px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~large-body-text~large-body-text\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"22px\",\"line-height\":\"24px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"~body-text~body-text\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"22px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"blockquote, ~blockquote\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"34px\",\"line-height\":\"38px\",\"font-weight\":\"500\",\"font-style\":\"italic\"}}}},\"theme_colors\":{\"primary-color\":\"#0078ca\",\"complementary-color\":\"#5884a6\",\"dark-color\":\"#2b2c33\",\"light-color\":\"#f2f2f2\",\"white-color\":\"#ffffff\"},\"theme_background\":{\"id\":\"template-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"#ffffff\",\"options\":[\"backgrounds\"],\"alias\":\"background\"}},\"theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"20px\",\"padding-bottom\":\"20px\"}}}},\"theme_dimensions\":{\"widthType\":\"option\",\"width\":\"100%\",\"height\":null},\"border\":{\"color\":\"#000000\",\"size\":\"0px\"},\"mobile_theme_font\":{\"children\":[]},\"mobile_theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"20px\",\"padding-bottom\":\"20px\"}}}}},\"mergedData\":\"\",\"formBlockIds\":[]},{\"templateId\":false,\"status\":false,\"blocks\":[],\"settings\":{\"favicon_uploader\":\"\\/\\/app.ontraport.com\\/favicon.png\",\"globalFormStyles\":{\"input_style\":\"default\",\"input_label_color\":\"#9e9e9e\",\"input_label_color_focus\":\"primary-color\",\"input_label_background_color\":\"transparent\",\"input_label_background_color_focus\":\"transparent\",\"input_label_font_style\":\"label\",\"input_label_position\":\"top\",\"input_label_width\":40,\"input_label_alignment\":\"left\",\"input_label_padding_top\":0,\"input_label_padding_bottom\":5,\"input_label_padding_right\":2,\"input_label_padding_left\":2,\"input_text_color\":\"dark-color\",\"input_text_color_hover\":\"dark-color\",\"input_bg_color\":\"white-color\",\"input_bg_color_hover\":\"white-color\",\"input_bg_color_focus\":\"white-color\",\"input_line_color\":\"#b9b9b9\",\"input_line_color_focus\":\"primary-color\",\"input_font_style\":\"body-text\",\"input_alignment\":\"left\",\"input_padding_top\":0,\"input_padding_bottom\":0,\"input_padding_left\":0,\"input_padding_right\":0,\"input_border\":[{\"attrs\":[],\"settings\":{\"border-position\":\"all\",\"border-style\":\"solid\",\"border-width\":\"1px\",\"border-color\":\"#b9b9b9\",\"border-color-hover\":\"#b9b9b9\",\"border-color-focus\":\"#b9b9b9\"}}],\"input_textarea_height\":\"3\",\"input_checkbox_border_color\":\"dark-color\",\"input_checkbox_checkmark_color\":\"primary-color\",\"input_checkbox_background_color\":\"dark-color\",\"input_checkbox_label_position\":\"right\",\"input_checkbox_margin_top\":0,\"input_dropdown_bg_color\":\"white-color\",\"input_dropdown_bg_color_hover\":\"light-color\",\"input_dropdown_bg_color_selected\":\"primary-color\",\"input_dropdown_color\":\"dark-color\",\"input_dropdown_color_hover\":\"dark-color\",\"input_dropdown_color_selected\":\"white-color\",\"input_dropdown_font_style\":\"body-text\",\"input_dropdown_border\":[{\"attrs\":[],\"settings\":{\"border-position\":\"all\",\"border-style\":\"none\",\"border-width\":\"1px\",\"border-color\":\"dark-color\",\"border-color-hover\":\"dark-color\"}}],\"input_icon_display\":\"none\",\"icon_size\":32,\"icon_color\":\"dark-color\",\"icon\":\"settings\",\"icon_type\":\"google\",\"input_label_line_height\":16,\"input_line_height\":22}},\"theme\":{\"theme_font\":{\"children\":{\"h1, ~h1~h1\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"60px\",\"line-height\":\"60px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"h2, ~h2~h2\":{\"attributes\":{\"font-family\":\"\'Work Sans\', sans-serif\",\"font-size\":\"36px\",\"line-height\":\"32px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"h3, ~h3~h3\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"20px\",\"line-height\":\"24px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~label~label\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"14px\",\"line-height\":\"14px\",\"font-weight\":\"500\",\"font-style\":\"normal\"}},\"~button~button\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"16px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~large-body-text~large-body-text\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"22px\",\"line-height\":\"24px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"~body-text~body-text\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"22px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"blockquote, ~blockquote\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"34px\",\"line-height\":\"38px\",\"font-weight\":\"500\",\"font-style\":\"italic\"}}}},\"theme_colors\":{\"primary-color\":\"#0078ca\",\"complementary-color\":\"#5884a6\",\"dark-color\":\"#2b2c33\",\"light-color\":\"#f2f2f2\",\"white-color\":\"#ffffff\"},\"theme_background\":{\"id\":\"template-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"#ffffff\",\"options\":[\"backgrounds\"],\"alias\":\"background\"}},\"theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"20px\",\"padding-bottom\":\"20px\"}}}},\"theme_dimensions\":{\"widthType\":\"option\",\"width\":\"100%\",\"height\":null},\"border\":{\"color\":\"#000000\",\"size\":\"0px\"},\"mobile_theme_font\":{\"children\":[]},\"mobile_theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"20px\",\"padding-bottom\":\"20px\"}}}}},\"mergedData\":\"\",\"formBlockIds\":[]},{\"templateId\":false,\"status\":false,\"blocks\":[],\"settings\":{\"favicon_uploader\":\"\\/\\/app.ontraport.com\\/favicon.png\",\"globalFormStyles\":{\"input_style\":\"default\",\"input_label_color\":\"#9e9e9e\",\"input_label_color_focus\":\"primary-color\",\"input_label_background_color\":\"transparent\",\"input_label_background_color_focus\":\"transparent\",\"input_label_font_style\":\"label\",\"input_label_position\":\"top\",\"input_label_width\":40,\"input_label_alignment\":\"left\",\"input_label_padding_top\":0,\"input_label_padding_bottom\":5,\"input_label_padding_right\":2,\"input_label_padding_left\":2,\"input_text_color\":\"dark-color\",\"input_text_color_hover\":\"dark-color\",\"input_bg_color\":\"white-color\",\"input_bg_color_hover\":\"white-color\",\"input_bg_color_focus\":\"white-color\",\"input_line_color\":\"#b9b9b9\",\"input_line_color_focus\":\"primary-color\",\"input_font_style\":\"body-text\",\"input_alignment\":\"left\",\"input_padding_top\":0,\"input_padding_bottom\":0,\"input_padding_left\":0,\"input_padding_right\":0,\"input_border\":[{\"attrs\":[],\"settings\":{\"border-position\":\"all\",\"border-style\":\"solid\",\"border-width\":\"1px\",\"border-color\":\"#b9b9b9\",\"border-color-hover\":\"#b9b9b9\",\"border-color-focus\":\"#b9b9b9\"}}],\"input_textarea_height\":\"3\",\"input_checkbox_border_color\":\"dark-color\",\"input_checkbox_checkmark_color\":\"primary-color\",\"input_checkbox_background_color\":\"dark-color\",\"input_checkbox_label_position\":\"right\",\"input_checkbox_margin_top\":0,\"input_dropdown_bg_color\":\"white-color\",\"input_dropdown_bg_color_hover\":\"light-color\",\"input_dropdown_bg_color_selected\":\"primary-color\",\"input_dropdown_color\":\"dark-color\",\"input_dropdown_color_hover\":\"dark-color\",\"input_dropdown_color_selected\":\"white-color\",\"input_dropdown_font_style\":\"body-text\",\"input_dropdown_border\":[{\"attrs\":[],\"settings\":{\"border-position\":\"all\",\"border-style\":\"none\",\"border-width\":\"1px\",\"border-color\":\"dark-color\",\"border-color-hover\":\"dark-color\"}}],\"input_icon_display\":\"none\",\"icon_size\":32,\"icon_color\":\"dark-color\",\"icon\":\"settings\",\"icon_type\":\"google\",\"input_label_line_height\":16,\"input_line_height\":22}},\"theme\":{\"theme_font\":{\"children\":{\"h1, ~h1~h1\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"60px\",\"line-height\":\"60px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"h2, ~h2~h2\":{\"attributes\":{\"font-family\":\"\'Work Sans\', sans-serif\",\"font-size\":\"36px\",\"line-height\":\"32px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"h3, ~h3~h3\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"20px\",\"line-height\":\"24px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~label~label\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"14px\",\"line-height\":\"14px\",\"font-weight\":\"500\",\"font-style\":\"normal\"}},\"~button~button\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"16px\",\"font-weight\":\"700\",\"font-style\":\"normal\"}},\"~large-body-text~large-body-text\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"22px\",\"line-height\":\"24px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"~body-text~body-text\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"16px\",\"line-height\":\"22px\",\"font-weight\":\"300\",\"font-style\":\"normal\"}},\"blockquote, ~blockquote\":{\"attributes\":{\"font-family\":\"\'Roboto\', sans-serif\",\"font-size\":\"34px\",\"line-height\":\"38px\",\"font-weight\":\"500\",\"font-style\":\"italic\"}}}},\"theme_colors\":{\"primary-color\":\"#0078ca\",\"complementary-color\":\"#5884a6\",\"dark-color\":\"#2b2c33\",\"light-color\":\"#f2f2f2\",\"white-color\":\"#ffffff\"},\"theme_background\":{\"id\":\"template-background\",\"type\":\"background\",\"for\":null,\"tag\":\"DIV\",\"attrs\":{\"bg\":\"#ffffff\",\"options\":[\"backgrounds\"],\"alias\":\"background\"}},\"theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"20px\",\"padding-bottom\":\"20px\"}}}},\"theme_dimensions\":{\"widthType\":\"option\",\"width\":\"100%\",\"height\":null},\"border\":{\"color\":\"#000000\",\"size\":\"0px\"},\"mobile_theme_font\":{\"children\":[]},\"mobile_theme_spacing\":{\"children\":{\"~spacing\":{\"attributes\":{\"padding-top\":\"20px\",\"padding-bottom\":\"20px\"}}}}},\"mergedData\":\"\",\"formBlockIds\":[]}]}",
    "dlm": 1538599582,
    "deleted": "false",
    "type": "11",
    "formname": "form_name",
    "form_id": 1
  },
  "account_id": 187157
}';
        }
        return 'Error: Unexpected object type as argument!';
    }

    function getInfo($objectType)
    {
        if($objectType === 'contact') {
            return "{\"code\": 0,
                      \"data\": {
                        \"listFields\": [
                          \"fn\",
                          \"email\",
                          \"office_phone\",
                          \"date\",
                          \"grade\",
                          \"dla\",
                          \"contact_id\"
                        ],
                        \"listFieldSettings\": [],
                        \"cardViewSettings\": [],
                        \"viewMode\": [],
                        \"count\": \"2\"
                      },
                      \"account_id\": 50
                    }";
        } elseif($objectType === 'message'){
            return  '{
  "code": 0,
  "data": {
    "listFields": [
      "name",
      "subject",
      "spam_score",
      "date",
      "type",
      "mcsent",
      "mcopened",
      "mcclicked",
      "mcnotopened",
      "mcnotclicked",
      "mcunsub",
      "mcabuse",
      "dlm"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "5"
  },
  "account_id": 187157
}';
        } elseif ($objectType === 'task'){
            return '{
  "code": 0,
  "data": {
    "listFields": [
      "",
      "owner",
      "subject",
      "status",
      "date_assigned",
      "date_due",
      "date_complete",
      "call_outcome_id",
      "contact_id"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "3"
  },
  "account_id": 187157
}';
        } elseif($objectType === 'form') {
            return '{
  "code": 0,
  "data": {
    "listFields": [
      "formname",
      "redirect",
      "fillouts",
      "visits",
      "type",
      "date",
      "dlm",
      "unique_fillouts",
      "unique_visits"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "1"
  },
  "account_id": 187157
}';
        }
        return 'Error: Unexpected object type as argument!';
    }

    function getMultiple($objectTypeToGet)
    {
        if($objectTypeToGet === 'contacts')
        {
            return '{
  "code": 0,
  "data": [
    {
      "id": "8",
      "owner": "1",
      "firstname": "unitUpdated",
      "lastname": "test"
    },
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test"
    }
  ],
  "account_id": 50,
  "misc": []
}';
        } elseif($objectTypeToGet === 'messages')
        {
            return '{
  "code": 0,
  "data": [
    {
      "id": "1",
      "alias": "test1",
      "type": "Template",
      "last_save": "1537912999"
    },
    {
      "id": "2",
      "alias": "Abandoned Cart: Did we lose you?",
      "type": "Template",
      "last_save": "1496332432"
    }
  ],
  "account_id": 187157,
  "misc": []
}';
        } elseif($objectTypeToGet === 'tasks'){
            return '{
  "code": 0,
  "data": [
    {
      "id": "1",
      "owner": "1",
      "drip_id": "0"
    },
    {
      "id": "2",
      "owner": "1",
      "drip_id": "0"
    }
  ],
  "account_id": 187157,
  "misc": []
}';
        } elseif($objectTypeToGet === 'forms') {
            return '{
  "code": 0,
  "data": [
    {
      "form_id": "1",
      "formname": "form_name",
      "type": "11",
      "tags": null,
    }
  ],
  "account_id": 187157,
  "misc": []
}';
        }
        return('Error: Unexpected object type as argument!');
    }

    function getMeta($objectType)
    {
        if ($objectType === 'contact') {
            return '{
  "code": 0,
  "data": {
    "0": {
      "name": "Contact",
      "fields": {
        "firstname": {
          "alias": "First Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "lastname": {
          "alias": "Last Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "email": {
          "alias": "Email",
          "type": "email",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        }
      }
    }
  },
  "account_id": 50
}';
        }
        elseif($objectType === 'message')
        {
            return '{
  "code": 0,
  "data": {
    "7": {
      "name": "Message",
      "fields": {
        "alias": {
          "alias": "Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "name": {
          "alias": "Name",
          "type": "mergefield",
          "required": "0",
          "unique": "0",
          "editable": 0,
          "deletable": "1"
        },
        "subject": {
          "alias": "Subject",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": 1,
          "deletable": "1"
        }
      }
    }
  },
  "account_id": 187157
}';
        }elseif($objectType === 'task'){
            return '{
  "code": 0,
  "data": {
    "1": {
      "name": "Task",
      "fields": {
        "owner": {
          "alias": "Assignee",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "1",
          "parent_object": 2
        },
        "contact_id": {
          "alias": "Contact",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": "0",
          "deletable": "1"
        }
      }
    }
  },
  "account_id": 187157
}';
        } elseif ($objectType === 'form'){
            return '{
  "code": 0,
  "data": {
    "122": {
      "name": "SmartFormFE",
      "fields": {
        "formname": {
          "alias": "Form Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": 1,
          "deletable": "1"
        },
        "redirect": {
          "alias": "Thank You Page",
          "type": "url",
          "required": "0",
          "unique": "0",
          "editable": null,
          "deletable": "1"
        }
      }
    }
  },
  "account_id": 187157
}';
        }
        return('Error: Unexpected object type as argument!');
    }


    function deleteSingleContact()
    {
        return '{
  "code": 0,
  "account_id": 50
}';
    }

    function deleteMultipleContacts()
    {
        return '{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}';
    }

    function create($objectType)
    {
        if($objectType === 'contact')
        {
            return '{
  "code": 0,
  "data": {
    "firstname": "unit",
    "lastname": "test",
    "use_utm_names": "false",
    "id": "8",
    "owner": "1",
  },
  "account_id": 50
}';
        } elseif($objectType === 'message')
        {
            return '{
  "code": 0,
  "data": {
    "id": 7,
    "date": "1538590526"
  },
  "account_id": 187157
}';
        }
        return('Error: Unexpected object type as argument!');
    }

    function update($objectType)
    {
        if ($objectType === 'contact') {
            return '{
  "code": 0,
  "data": {
    "attrs": {
      "firstname": "unitUpdated",
      "dlm": "1538154601",
      "id": "8"
    }
  },
  "account_id": 50
}';
        } elseif($objectType === 'message'){
            return '{
  "code": 0,
  "data": {
    "id": "7",
    "date": "1538590526"
  },
  "account_id": 187157
}';
        } elseif($objectType === 'task'){
            return '{
  "code": 0,
  "data": {
    "attrs": {
      "date_due": "4",
      "id": "1"
    }
  },
  "account_id": 187157
}';
        }
        return('Error: Unexpected object type as argument!');
    }

    function saveOrUpdateContact()
    {
        return '{
  "code": 0,
  "data": {
    "use_utm_names": "false",
    "firstname": "unitUpdated",
    "lastname": "updatedLastName",
    "id": "9",
    "owner": "1",
  },
  "account_id": 50
}';
    }

    function retrieveFields()
    {
        return '{
  "code": 0,
  "data": {
    "1": {
      "id": 1,
      "name": "Contact Information",
      "description": null,
      "fields": [
        [
          {
            "id": 198,
            "alias": "Name",
            "field": "fn",
            "type": "mergefield",
            "required": 0,
            "unique": 0,
            "editable": 0,
            "deletable": 0,
            "options": "<op:merge field=\'firstname\'>X</op:merge> <op:merge field=\'lastname\'>X</op:merge>"
          },
          {
            "id": 1,
            "alias": "First Name",
            "field": "firstname",
            "type": "text",
            "required": 0,
            "unique": 0,
            "editable": 1,
            "deletable": 0,
            "options": ""
          }
        ]
      ]
    }
  },
  "account_id": 50
}';
    }

    function createFields()
    {
        return '{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string"
    },
    "error": []
  },
  "account_id": 50
}';

    }

    function updateFields()
    {
        return '{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string",
      "description": "string2"
    }
  },
  "account_id": 50
}';
    }

    function deleteFields()
    {
        return '{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}';
    }

    function getObjectByEmail()
    {
        return '{
  "code": 0,
  "data": {
    "id": "10"
  },
  "account_id": 50
}';
    }

    function tagObjectByName()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function getObjectsWithTag(){
        return '{
  "code": 0,
  "data": [
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test",
    }
  ],
  "account_id": 50
}';
    }

    function pause()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function unpause()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function addToSequence()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function removeFromSequence()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function subscribe()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function unsubscribe()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function addTag()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function removeTag()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function addTagByName()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function removeTagByName()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function assignTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function rescheduleTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function cancelTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function completeTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function getBlocksByFormName()
    {
        return '{
  "code": 0,
  "data": {
    "block_ids": [
      "f1"
    ]
  },
  "account_id": 187157
}';
    }

    function getAllFormBlocks()
    {
        return '{
  "code": 0,
  "data": {
    "f1": "form_name"
  },
  "account_id": 187157
}';
    }

    function getSmartFormData()
    {
        return '{
  "code": 0,
  "data": {
    "f1": "form_na{
  "code": 0,
  "data": "html form data would be here"
  "account_id": 187157
}me"
  },
  "account_id": 187157
}';
    }

}
