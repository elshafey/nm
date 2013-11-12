<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Forms
 *
 * @author elshafey
 */
class Forms {

    /**
     *
     * @var CMS 
     */
    public $cms;

    /** @var My_Controller   */
    static $CI;
    protected $fields;

    public function __construct(CMS $cms) {
        $this->cms = $cms;
        self::$CI = get_instance();
    }

    public function populate() {
        
    }

    public function validate() {
        self::$CI->form_validation->set_error_delimiters('<span class="frm_error_msg">', '</span>');
        foreach ($this->cms->render_fields as $key) {
            $field = $this->cms->columns[$key];
            if (isset($field['multi']) && $field['multi']) {
                foreach (get_lang_list() as $code => $lang) {
                    self::$CI->form_validation->set_rules($key . "_$code", '', $field['validation']);
                }
            } elseif ($field['value'] instanceof CMS) {
                $cms = $this->cms;
                $this->cms = $field['value'];
                $this->validate();
                $this->cms = $cms;
            } else {
                self::$CI->form_validation->set_rules($key, '', $field['validation']);
            }
        }
        return self::$CI->form_validation->run();
    }

    public function process() {
        if ($_POST && $this->validate()) {

            foreach ($this->cms->render_fields as $key) {
                $field = $this->cms->columns[$key];
                if (isset($field['multi']) && $field['multi']) {
                    foreach (get_lang_list() as $code => $lang) {
                        $value[$code] = $_POST[$key . "_$code"];
                    }
                    $this->cms->$key = $value;
                } elseif (isset($field['value']) && $field['value'] instanceof CMS) {
                    $this->process_subpage($field['value']);
                } elseif (isset($_POST[$key])) {
                    $value = $_POST[$key];
                    $this->cms->$key = $value;
                }
                if (isset($value)) {
                    unset($value);
                }
            }
//            pre_print($_POST);
            $this->cms->save();
            return true;
        }
        return false;
    }

    protected function process_subpage(CMS &$cms) {
        foreach ($cms->render_fields as $key) {
            $field = $cms->columns[$key];
            if (isset($field['multi']) && $field['multi']) {
                foreach (get_lang_list() as $code => $lang) {
                    $value[$code] = $_POST[$key . "_$code"];
                }
                $cms->$key = $value;
            } elseif (isset($field['value']) && $field['value'] instanceof CMS) {
                $this->process_subpage($field['value']);
            } elseif (isset($_POST[$key])) {
                $value = $_POST[$key];
                $cms->$key = $value;
            }
            if (isset($value)) {
                unset($value);
            }
        }
    }

    protected function buildFields(array $fields) {
        foreach ($fields as $field) {
            switch ($this->cms->columns[$field]['outType']) {
                case 'textbox':
                    $this->addTxtBox($this->cms->columns[$field]);
                    break;
                case 'img_uploader':
                    $this->addImgUploader($this->cms->columns[$field]);
                    break;
                case 'file_uploader':
                    $this->addImgUploader($this->cms->columns[$field]);
                    break;
                case 'content':
                    $this->addContentBox($this->cms->columns[$field]);
                    break;
                case 'textarea':
                    $this->addTxtarea($this->cms->columns[$field]);
                    break;
                case 'url':
                    $this->addURLInfo($this->cms->columns[$field]);
                    break;
                case 'checkbox':
                    $this->addChkBox($this->cms->columns[$field]);
                    break;
                case 'select':
                    $this->addSelect($this->cms->columns[$field]);
                    break;
                case 'hidden':
                    $this->addHidden($this->cms->columns[$field]);
                    break;
                case 'password':
                    $this->addPassword($this->cms->columns[$field]);
                    break;
                default:
                    break;
            }
        }
    }

    public function renderFields(array $fields = array()) {
        if (!$fields)
            $fields = $this->cms->render_fields;
        if (!$this->fields) {
            $this->buildFields($fields);
        }

        foreach ($this->fields as $field) {
            echo $field;
        }
    }

    public function getFieldHTML($field_name) {
        if (!array_key_exists($field_name, $this->fields)) {
            $this->buildFields(array($field_name));
        }

        return $this->fields[$field_name];
    }

    public function addSelect($field) {
        $id = ($field['value'] instanceof \Entities\Pages) ? $field['value']->getId() : $field['value'];

        $select_txt_field = $field['select_txt_field'];
        $select = '<select name="%s" id="%s">';
        $select.='<option value="">' . lang('global_select') . '</option>';

        foreach ($field['select_list'] as $value) {
            $select.='<option value="' . $value['id'] . '" ' . ($id == $value['id'] ? 'selected="selected"' : '') . ' >'
                    . (is_array($value[$select_txt_field]) ? $value[$select_txt_field][get_locale()] : $value[$select_txt_field])
                    . '</option>';
        }
        $select.='</select>';
        $this->fields[$field['name']] = $this->buildCommonHtml($field, $select);
    }

    public function addImgUploader($field) {
        $required = in_array('required', explode('|', $field['validation']));
        $fld_html = '<input name="%s" class="txtbox" id="%s" value="%s" ' . ($required ? 'readonly="readonly"' : '') . '>'
                . ' <input type="button" onclick="' . $field['name'] . 'BrowseServer();" value="' . lang('global_btn_browse') . '">'
                . ($required ? ' <span class="star">*</span>' : '')
                . '<div id="img_thumb"></div>'
                . file_finder_txt($field['name'])

        ;
        $this->fields[$field['name']] = $this->buildCommonHtml($field, $fld_html);
    }

    public function addURLInfo($field) {
        $cms = $this->cms;
        $this->cms = $field['value'];
        $this->buildFields($this->cms->render_fields);
        $this->cms = $cms;
    }

    public function addTxtBox($field) {
        $fld_html = '<input name="%s" class="txtbox" id="%s" value="%s" /> ';
        $this->fields[$field['name']] = $this->buildCommonHtml($field, $fld_html);
    }

    public function addPassword($field) {
        $fld_html = '<input name="%s" type="password" class="txtbox" id="%s" value="" /> ';

        $temp = $this->buildCommonHtml($field, $fld_html);
        $field['name'] = $field['name'] . '_confirm';
        $this->fields[$field['name']] = $temp . $this->buildCommonHtml($field, $fld_html);
    }

    public function addHidden($field) {
        $field_name = $field['name'];
        $value = $this->getFieldValue($field);
        $fld_html = '<input name="%s" type="hidden" class="txtbox" id="%s" value="%s" /> ';
        $this->fields[$field['name']] = sprintf($fld_html, $field_name, $field_name, $value);
    }

    public function addChkBox($field) {
        $value = $this->getFieldValue($field);
        $fld_html = '<input type="checkbox" name="%s" class="chkbox" id="%s" value="%s" ' . ($value ? 'checked=checked' : '') . ' />';
        $this->fields[$field['name']] = $this->buildCommonHtml($field, $fld_html);
    }

    public function addContentBox($field) {
        $this->fields[$field['name']] = $this->buildCommonHtml($field, '');
    }

    public function addTxtarea($field) {
        $fld_html = '<textarea name="%s" id="%s" class="">%s</textarea>';
        $this->fields[$field['name']] = $this->buildCommonHtml($field, $fld_html);
    }

    public function getFieldValue($field) {
        if ($field['value'] instanceof Entities\Pages) {
            return $field['value']->getId();
        } else {
            if (isset($field['multi']) && $field['multi']) {
                if ($_POST) {
                    foreach (get_lang_list() as $key => $lang) {
                        $value[$key] = $_POST[$field['name'] . "_$key"];
                    }
                } else {
                    return $field['value'];
                }
                return $value;
            } else {
                if ($_POST) {
                    return $_POST[$field['name']];
                } else {
                    return $field['value'];
                }
            }
        }
    }

    public function buildCommonHtml($field, $field_html) {
        $namespace = $this->cms->namespace;
        $field_name = $field['name'];
        $required = isset($field['required']) && $field['required'];
        $value = $this->getFieldValue($field);

        $html = '';
        if (isset($field['multi']) && $field['multi']) {
            foreach (get_lang_list() as $key => $lang) {
                if (!isset($value[$key]))
                    $value[$key] = '';
                $new_fld = $field_name . "_$key";
                $li = '<li id="li_' . $new_fld . '">';
                $li.=lang($namespace . '_' . $new_fld, $new_fld);
                $li.='%s';
                if ($required) {
                    $li.='<span class="star">*</span>';
                }
                $li.=form_error($new_fld);
                $li.='</li>';
                if ($field['outType'] == 'content') {
//                    pre_print($_POST);
                    $html.= sprintf($li, load_editor($new_fld, htmlspecialchars_decode($value[$key])));
                } elseif ($field['outType'] == 'file_uploader') {
                    $html.= sprintf($li, sprintf($field_html, $new_fld, $new_fld, $value[$key]));
                    $html = str_replace('pdfBrowseServer', $field_name . '_' . str_replace('-', '_', $key) . '_BrowseServer', $html);
                    $html = str_replace('pdfSetFileField', $field_name . '_' . str_replace('-', '_', $key) . '_SetFileField', $html);
                    $html = str_replace('"pdf"', '"' . $new_fld . '"', $html);
                    $html = str_replace('"#pdf"', '"#' . $new_fld . '"', $html);
//                    echo $html;exit;
                } else {
                    $html.= sprintf($li, sprintf($field_html, $new_fld, $new_fld, $value[$key]));
                }
            }
        } else {
            $li = '<li id="li_' . $field_name . '">';
            $li.=lang($namespace . '_' . $field_name, $field_name);
            $li.='%s';
            if ($required) {
                $li.=' <span class="star">*</span>';
            }
            $li.=form_error($field_name);
            $li.='</li>';
            if ($field['outType'] == 'content') {
                $field_html = load_editor($field_name, $value);
                $html.= sprintf($li, $field_html);
            } else {
                $html.= sprintf($li, sprintf($field_html, $field_name, $field_name, $value));
            }
        }

        return $html;
    }

}

?>
