<?php 

/************************************
	*notes:HTML生成辅助类
	*Author:04007.cn
	*Time:2018-03-18
*************************************/



class Htmlhelp{
	
	//根据配置项配置返回表单
    static function makeInput($set= array(), $default)
    {
        $html = '';
        switch($set['config_htmltype'])
        {
            case 'text':$html = self::makeText($set, $default);break;
            case 'textarea':$html = self::makeTextarea($set, $default);break;
            case 'radio':$html = self::makeRadio($set, $default);break;
            case 'checkbox':$html = self::makeCheckbox($set, $default);break;
        }
        return $html;
    }
	
    static function makeText($set, $default)
    {
        $helpChar = $set['config_help']?"<div class='help-block'> &nbsp;{$set['config_help']}</div>":'';
        $textSize = intval($set['config_widthheight']);
        $textSize <1 && $textSize=2;
        $forceKey = array('lastExchangeRate','exchangeRate');
        $default = (in_array($set['config_key'],$forceKey) || $default===false)?$set['config_value']:$default;
        $disabled =  in_array($set['config_key'],$forceKey) ? 'disabled' : '';
$html =
<<<EOF
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">{$set['config_name']}：</label>
            <div class="col-sm-9" style="border-bottom:1px solid #eee;">
                <input type="text" {$disabled} id="{$set['config_key']}" name="{$set['config_key']}" class="col-xs-10 col-sm-{$textSize}" value="{$default}" />
                {$helpChar}
            </div>
        </div>
EOF;
    return $html;
    }
    
    static function makeTextarea($set, $default)
    {
        $width = intval($set['config_widthheight']);
        $default = $default===false?$set['config_value']:$default;
$html =
<<<EOF
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">{$set['config_name']}：</label>
            <div class="col-sm-{$width}" style="border-bottom:1px solid #eee;">
                <textarea rows="3" class="form-control col-sm-12" id="{$set['config_key']}" name="{$set['config_key']}" placeholder="Default Text">{$default}</textarea>
                {$helpChar}
            </div>
        </div>
EOF;
        return $html;
    }
    
    static function makeRadio($set, $default)
    {
        $optionArr = array();
        $valArr = explode('|', $set['config_htmlvalue']);
        $default = $default===false?$set['config_value']:$default;
        
        foreach($valArr as $value)
        {
            @list($val, $char) = explode(':', $value);
            $check = $default==$val?'checked="checked"':'';
            $optionArr[] = 
                "<label><input name='{$set['config_key']}' value='{$val}' {$check} type='radio' class='ace' >"
                . "<span class='lbl'> {$char}</span></label>";
        }
        $optionChar = implode("\n&nbsp;",$optionArr);
$html =
<<<EOF
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">{$set['config_name']}：</label>
            <div class="col-sm-9" style="border-bottom:1px solid #eee;">
                {$optionChar}
            </div>
        </div>
EOF;
        return $html;
    }
    
    static function makeCheckbox($set, $default)
    {
        $optionArr = array();
        $valArr = explode('|', $set['config_htmlvalue']);
        $default = $default===false?$set['config_value']:$default;
        $defaultArr = explode('|', $default);

        foreach($valArr as $value)
        {
            @list($val, $char) = explode(':', $value);
            $check = in_array($val, $defaultArr)?'checked="checked"':'';
            $optionArr[] = 
                "<label><input name='{$set['config_key']}[]' value='{$val}' {$check} type='checkbox' class='ace'>
                    <span class='lbl'> {$char}</span></label>";
        }
        $optionChar = implode("\n&nbsp;",$optionArr);
$html =
<<<EOF
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">{$set['config_name']}：</label>
            <div class="col-sm-9" style="border-bottom:1px solid #eee;">
                {$optionChar}
            </div>
        </div>
EOF;
        return $html;
    }


}
