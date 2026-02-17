<?php

/**
 * Validation class
 */
class Validation
{

    /**
     * validator config
     *
     * @var array
     */
    private $config;

    /**
     * messages
     *
     * @var array
     */

    private $messages = array(
        'required' => 'Le champs %label% est obligatoire.',
        'int' => 'Le champs %label% doit etre entier',
        'alpha' => 'Le champs %label% doit etre alphabetique',
        'alphanum' => 'Le champs %label% doit etre alphanumérique',
        'email' => 'Cet email n\'est pas valide',
        'tel' => 'Numéro de téléphone invalide. Prière de le modifier.',
        'text' => 'Le champs %label% ne doit pas contenir des caractères spéciaux',
        'date' => 'Le champs %label% n\'est pas une date valide',
    );

    /**
     * messages
     *
     * @var array
     */

    private $message = array();
    /**
     *
     * @param type description
     */
    public function __construct($config)
    {
        if ($config && is_array($config)) {
            $this->config = $config;
        } else {
            throw new \Exception("Error Processing validator, your config is uncorrect", 1);
        }
    }

    /**
     * validate int
     *
     * @param string/int $item
     * @return return boolean
     */
    public function int($item)
    {
        return is_integer($item) || trim($item) === '';
    }

    /**
     * validate text
     *
     * @param string $item
     * @return return boolean
     */
    public function text($item)
    {
        return preg_match('@^[\'ôéèêçà\d\w%:&^$#!\?\s~\*\'"/.\(\)/,;\+\-\@]+$@i', $item) || trim($item) === '';
    }
    /**
     * validate text
     *
     * @param string $item
     * @return return boolean
     */
    public function html($item)
    {
        return $this->xss_clean($item) === $item || trim($item) === '';
    }

    /**
     * validate tel
     *
     * @param string $item
     * @return return boolean
     */
    public function tel($item)
    {
        return preg_match('/^[\d\s\+]{6,15}$/i', $item) || trim($item) === '';
    }

    /**
     * validate date
     *
     * @param string $item
     * @return return boolean
     */
    public function date($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date || trim($date) === '';
    }

    /**
     * validate alpha num
     *
     * @param string $item
     * @return return boolean
     */
    public function alphanum($item)
    {
        return ctype_alnum($item) || trim($item) === '';
    }

    /**
     * validate alpha
     *
     * @param string $item
     * @return return boolean
     */
    public function alpha($item)
    {
        return ctype_alpha($item) || trim($item) === '';
    }

    /**
     * validate alpha
     *
     * @param string $item
     * @return return boolean
     */
    public function required($item)
    {
        $item = trim($item);
        return strlen($item) > 0;
    }

    /**
     * validate email
     *
     * @param string $item
     * @return return boolean
     */
    public function email($item)
    {
        $pattern = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

        return preg_match($pattern, $item) || trim($item) === '';
    }

    /**
     * run validator
     *
     * @param string $item
     * @return return sting
     */
    public function getMessage($item = NULL, $seperator = NULL)
    {
        if ($item) {
            return isset($this->message[$item]) ? $this->message[$item] : 1;
        } else {
            if (!$seperator)
                return implode("<br><br>", $this->message);
            else
                return implode($seperator, $this->message);
        }
    }

    /**
     * run validator
     *
     * @param string $item
     * @return return boolean
     */
    public function run()
    {
        $return = TRUE;
        foreach ($this->config as $field => $config) {
            $filters = explode('|', $config['filter']);
            $label = $config['label'];
            /* cleaners */
            if (in_array('trim', $filters) && is_array($_POST[$field])) {
                foreach ($_POST[$field] as $key => $post)
                    $_POST[$field][$key] = trim($post);
            } elseif (in_array('trim', $filters)) {
                $_POST[$field] = trim($_POST[$field]);
            }

            if (in_array('strip_tags', $filters) && is_array($_POST[$field])) {
                foreach ($_POST[$field] as $key => $post)
                    $_POST[$field][$key] = strip_tags($post);
            } elseif (in_array('strip_tags', $filters)) {
                $_POST[$field] = strip_tags($_POST[$field]);
            }

            if (in_array('xss_clean', $filters) && is_array($_POST[$field])) {
                foreach ($_POST[$field] as $key => $post)
                    $_POST[$field][$key] = $this->xss_clean($post);
            } elseif (in_array('xss_clean', $filters)) {
                $_POST[$field] = $this->xss_clean($_POST[$field]);
            }
            /* cleaners */

            foreach ($filters as $key => $filter) {
                if (in_array($filter, array('trim', 'strip_tags', 'xss_clean'))) {
                    continue;
                }

                $valid = true;
                if (is_array($_POST[$field])) {
                    foreach ($_POST[$field] as $key => $post)
                        $valid = $this->{$filter}($_POST[$field][$key]);
                } else {
                    $valid = $this->{$filter}($_POST[$field]);
                }

                if (!$valid) {
                    $this->message[$field]  = str_replace('%label%', $label, $this->messages[$filter]);
                }

                $return  = $return && $valid;
            }
        }
        return $return;
    }

    public function xss_clean($data)
    {
        # Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        # Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        # Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        # Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        # Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);

        return $data;
    }
}

function getView($view, $data = array(), $layout = '_layout')
{
    global $app;
    ob_start();
    extract($data);
    if (Request::isAdmin() && Config::get('extranet')) {
        include _basepath . (Config::get('extranet') . '/') . 'pages/' . $layout . '.php';
        exit;
    }

    include _basepath . ((Request::isAdmin() && Config::has('admin') && Config::get('admin')) ? Config::get('admin') . '/' : '') . 'pages/' . $layout . '.php';

    $result = ob_get_clean();

    return $result;
}


function loadView($view, $data = array(), $layout = '_layout')
{
    global $app;
    ob_start();
    extract($data);
    if (Request::isAdmin() && Config::get('extranet')) {
        include _basepath . (Config::get('extranet') . '/') . 'pages/' . $layout . '.php';
        exit;
    }

    include _basepath . ((Request::isAdmin() && Config::has('admin') && Config::get('admin')) ? Config::get('admin') . '/' : '') . 'pages/' . $layout . '.php';

    $result = ob_get_clean();

    echo $result;
    exit;
}

function cf_token()
{
    if (!isset($_SESSION['cf_token_rexpired']) || $_SESSION['cf_token_rexpired']) {
        $token = base64_encode(sha1(time() . rand()));
        $_SESSION['cf_token'] = $token;
        $_SESSION['cf_token_rexpired'] = FALSE;
    } else {
        $token = $_SESSION['cf_token'];
    }

    return $token;
}

function cf_fields()
{
    return "<input type='hidden' name='cf_token' value='" . cf_token() . "'/>";
}

function assets($path)
{
    return URL::base() . "assets/{$path}";
}

function verify_token($token, $refresh = TRUE)
{
    $sess_token = $_SESSION['cf_token'];
    $_SESSION['cf_token_rexpired'] = true;

    // refresh the token     
    if ($refresh) {
        cf_token();
    }

    return $sess_token === $token;
}
function verify_fg_profile_sh($fg_profile_sh)
{

    $user = Session::getInstance()->getCurUser();
    $sess_fg_profile_sh = $user ? $user->get('Fingerprint') : '';

    return $sess_fg_profile_sh === $fg_profile_sh;
}


function loadView404()
{
    loadView('erreur404');
}

function executeLink($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


function getJson($string, $table = false)
{
    if ($table)
        return json_decode($string, true);
    else
        return json_decode($string);
}


function filter_scripts($posts = NULL)
{
    if (!$posts)
        $posts = $_POST;

    foreach ($_POST as $key => $post) {
        if (is_array($post)) {
            // recursive
            // print_r($post);exit;
            // filter_scripts($post);
        } else {
            $_POST[$key] = preg_replace('%<script.*>.+(<\s*/\s*script\s*>)?%i', "", $post);
        }
    }
}


function secure_csrf($posts = NULL)
{
    if (!$posts)
        $posts = $_POST;

    /* If a form sent a post request */
    if (count($posts)) {
        if (!isset($posts['cf_token']))
            throw new Exception("Forbidden Request !", 403);

        if (!verify_token($posts['cf_token']))
            throw new Exception("Forbidden Request, your token has expired !", 403);
    }
}

function secure_fg_profile_sh($posts = NULL)
{
    if (!$posts)
        $posts = $_POST;

    /* If a form sent a post request */
    if (count($posts)) {
        if (!isset($posts['fg_profile_sh']) && !isset($posts['no_fg_profile_sh'])) {
            throw new Exception("Forbidden Request fg_profile_sh !", 403);
        }

        if (isset($posts['fg_profile_sh']) && !verify_fg_profile_sh($posts['fg_profile_sh']) && !isset($posts['no_fg_profile_sh'])) {

            Session::getInstance()->unsetCurUser();
            exit("Forbidden Request, your fg_profile_sh has expired !");
        }
    }
}

function send_notification_firebase($tokens, $message, $device)
{
    $url = 'https://fcm.googleapis.com/fcm/send';

    if ($device == 'ios')
        $fields = array(
            'registration_ids' => $tokens,
            'notification'    => $message
        );
    else
        $fields = array(
            'registration_ids' => $tokens,
            "data" => $message
        );

    $headers = array(
        'Authorization:key = ' . Config::get('firebase-server-api-access-key'),
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}


function loadLib($lib, $required = false)
{
    $libPath = _basepath . 'libs/' . $lib . '/load.php';
    if (!file_exists($libPath))
        throw new \Exception('Library ' . $lib . ' could not be loaded, either folder missing, or load file not configured');
    if ($required)
        require_once $libPath;
    else
        include_once $libPath;
}

function roleIs()
{
    $args = func_get_args();
    return in_array(Session::getInstance()->getCurRoleAlias(), $args);
}

// Special Chars to HTML Entities
function html($txt, $decode = false)
{
    if ($decode)
        return html_entity_decode($txt, ENT_COMPAT, 'UTF-8');
    else
        return htmlentities($txt, ENT_COMPAT, 'UTF-8');
}

function __($key, $replace = null)
{
    echo Models\Translation::translate($key, $replace);
}


//----------------------------------------------------------------------Error Report Page
function errorPage($errors)
{
    global $depth;
    if (!$errors) return;
    if (!is_array($errors)) $errors = array($errors);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php
        $pageTitle = 'Message d\'erreur';
        ?>
        <style>
            * {
                padding: 0;
                margin: 0;
            }

            body {}

            #error-container {
                max-width: 960px;
                margin: 80px auto 0;
                padding: 20px 30px 30px;
                box-shadow: 0 1px 5px #666;
                background: #fff;
                border-radius: 3px;
            }

            .errors {
                font-size: 1.2em;
                padding-left: 25px;
                margin-bottom: 20px;
            }

            .errors li {
                margin: 0 0 10px;
            }

            #link-back {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <section id="error-container">
            <ul class="errors">
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo $error ?></li>
                <?php } ?>
            </ul>
            <div id="link-back">
                <a href="#" onClick="history.go(-1); return false;">Retour</a>
            </div>
        </section>
    </body>

    </html>
<?php
    exit;
}



function hash_encode($param, $hashlength = null)
{
    loadLib('hashids');
    $hashKey = \Config::get('hashsecretkey');
    $hashKey .= 'Encode:)';
    $hashids = new \Hashids\Hashids($hashKey, $hashlength ? $hashlength : \Config::get('hashlength'), \Config::get('hashchars'));
    return $hashids->encode($param);
}
function hash_decode($param, $hashlength = null)
{
    loadLib('hashids');
    $hashKey = \Config::get('hashsecretkey');
    $hashKey .= 'Encode:)';
    $hashids = new \Hashids\Hashids($hashKey, $hashlength ? $hashlength : \Config::get('hashlength'), \Config::get('hashchars'));
    $hashidsDecode = $hashids->decode($param);
    return $hashidsDecode[0];
}
