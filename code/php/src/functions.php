<?php
/**
 * 遍历指定路径的文件夹中的文件
 * @param $dirPath 文件绝对路径
 * @param $type 遍历方法 默认参数为 $type='all' 返回所有文件作为一维数组返回,如果$type='file'，则与多维数组返回
 * @return array 检索到文件成功返回内部文件路径数组，失败返回false;
 */
function traverseDir($dirPath=false, $type='all'){
    //检测是否为文件夹
    if(!$dirPath || !is_dir($dirPath)){
        return false;
    }
    $files = array();

    //增加一个@抑制错误
    if(@$handle = opendir($dirPath)){
        while(($file = readdir($handle)) !== false){
            //排除'.'当前目录和'..'上级目录
            if($file != '..' && $file != '.'){
                //只记录文件
                if($type == 'file'){
                    if(is_dir($dirPath . DIRECTORY_SEPARATOR . $file)){
                        //如果是文件夹，则重新遍历该文件的文件
                        $files[$file] = traverseDir($dirPath . DIRECTORY_SEPARATOR . $file, 'file');
                        //把文件存入数组中
                        foreach($files[$file] as $k => $v){
                            if(is_file($v)){
                                $files[] = $v;
                                //删除源数组中的对应文件路径
                                unset($files[$file][$k]);
                            }
                        }

                        //删除源数组中的对应文件路径数组
                        unset($files[$file]);
                    }else{
                        //如果是文件则直接存入数组
                        $files[] = $dirPath . DIRECTORY_SEPARATOR . $file;
                    }
                }else{//记录含文件
                    if(is_dir($dirPath . DIRECTORY_SEPARATOR . $file)){
                        //如果是文件夹，则重新遍历该文件的文件
                        $files[$file] = traverseDir($dirPath . DIRECTORY_SEPARATOR . $file);
                    }else{
                        //如果是文件则直接存入数组
                        $files[] = $dirPath . DIRECTORY_SEPARATOR . $file;
                    }
                }
            }
        }
        closedir($handle);
    }
    return $files;
}
?>
