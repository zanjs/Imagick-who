<?php


 /**
* 返回一个字符的数组
*
* @param $str      文字
* @param $charset  字符编码
* @return $match   返回一个字符的数组
*/
function charArray($str,$charset="utf-8"){
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);

    return $match;
}

 /**
* 返回一个字符串在图片中所占的宽度
* @param $fontsize  字体大小
* @param $fontangle 角度
* @param $ttfpath   字体文件
* @param $char      字符
* @return $width
*/
function charwidth($fontsize,$fontangle,$ttfpath,$char){
    $box = imagettfbbox($fontsize,$fontangle,$ttfpath,$char);
    $width = max($box[2], $box[4]) - min($box[0], $box[6]);
    return $width;
}


/**
* 根据预设宽度让文字自动换行
* @param $fontsize   字体大小
* @param $ttfpath    字体名称
* @param $str    字符串
* @param $width    预设宽度
* @param $fontangle  角度
* @param $charset    编码
* @return $_string  字符串
*/
function autowrap($fontsize,$ttfpath,$str,$width,$fontangle=0,$charset='utf-8'){
    $_string = "";
    $_width  = 0;
    $temp    = $this->chararray($str);
    foreach ($temp[0] as $v){
        $w = $this->charwidth($fontsize,$fontangle,$ttfpath,$v);
        $_width += intval($w);
        if (($_width > $width) && ($v !== "")){
            $_string .= PHP_EOL;
            $_width = 0;
        }
        $_string .= $v;
    }

    return $_string;
}


/**
 * 实现php后台里，指定文字大小时，单位转换
 * @param $px
 * @return int
 */
 function px2dp($px){
    $map=array(
        0,4,
        5,
        7,
        8,
        9,
        10,
        11,
        12,
        14,
        15,
        16,
        17,
        18,
        19,
        21,
        22,
        23,
        25,
        26,
        27,
        28,
        29,
        30,
        32,
        33,
        34,
        35,
        36,
        38,
        39,
        40,
        41,
        43,
        44,
        46,
        47,
        48,
        48,
        50,
        51);

    //遍历数组
    for($i=1;$i<count($map);$i++){
        //恰好有匹配的磅值
        if($map[$i]==$px){
            return $i;
        }

        //如果当前像素值恰好在两个磅值之间
        if($map[$i]<$px && $map[$i+1]>$px){
            return $i+0.5;
        }
    }
}


/*/附录-->磅转像素表
 * 1磅==>4像素, PPI=288
2磅==>5像素, PPI=180
3磅==>7像素, PPI=168
4磅==>8像素, PPI=144
5磅==>9像素, PPI=129.6
6磅==>10像素, PPI=120
7磅==>11像素, PPI=113.14285714286
8磅==>12像素, PPI=108
9磅==>14像素, PPI=112
10磅==>15像素, PPI=108
11磅==>16像素, PPI=104.72727272727
12磅==>17像素, PPI=102
13磅==>18像素, PPI=99.692307692308
14磅==>19像素, PPI=97.714285714286
15磅==>21像素, PPI=100.8
16磅==>22像素, PPI=99
17磅==>23像素, PPI=97.411764705882
18磅==>25像素, PPI=100
19磅==>26像素, PPI=98.526315789474
20磅==>27像素, PPI=97.2
21磅==>28像素, PPI=96
22磅==>29像素, PPI=94.909090909091
23磅==>30像素, PPI=93.913043478261
24磅==>32像素, PPI=96
25磅==>33像素, PPI=95.04
26磅==>34像素, PPI=94.153846153846
27磅==>35像素, PPI=93.333333333333
28磅==>36像素, PPI=92.571428571429
29磅==>38像素, PPI=94.344827586207
30磅==>39像素, PPI=93.6
31磅==>40像素, PPI=92.903225806452
32磅==>41像素, PPI=92.25
33磅==>43像素, PPI=93.818181818182
34磅==>44像素, PPI=93.176470588235
35磅==>46像素, PPI=94.628571428571
36磅==>47像素, PPI=94
37磅==>48像素, PPI=93.405405405405
38磅==>48像素, PPI=90.947368421053
39磅==>50像素, PPI=92.307692307692
40磅==>51像素, PPI=91.8
41磅==>52像素, PPI=91.317073170732
42磅==>53像素, PPI=90.857142857143
43磅==>55像素, PPI=92.093023255814
44磅==>56像素, PPI=91.636363636364
45磅==>57像素, PPI=91.2
46磅==>58像素, PPI=90.782608695652
47磅==>60像素, PPI=91.914893617021
48磅==>62像素, PPI=93
49磅==>63像素, PPI=92.571428571429
50磅==>63像素, PPI=90.72
51磅==>64像素, PPI=90.352941176471
52磅==>67像素, PPI=92.769230769231
53磅==>68像素, PPI=92.377358490566
54磅==>69像素, PPI=92
55磅==>70像素, PPI=91.636363636364
56磅==>71像素, PPI=91.285714285714
57磅==>72像素, PPI=90.947368421053
58磅==>74像素, PPI=91.862068965517
59磅==>75像素, PPI=91.525423728814
60磅==>76像素, PPI=91.2
61磅==>77像素, PPI=90.885245901639
62磅==>78像素, PPI=90.58064516129
63磅==>79像素, PPI=90.285714285714
64磅==>81像素, PPI=91.125
65磅==>83像素, PPI=91.938461538462
66磅==>84像素, PPI=91.636363636364
67磅==>85像素, PPI=91.34328358209
68磅==>86像素, PPI=91.058823529412
69磅==>86像素, PPI=89.739130434783
70磅==>88像素, PPI=90.514285714286
71磅==>90像素, PPI=91.267605633803
72磅==>91像素, PPI=91
73磅==>92像素, PPI=90.739726027397
74磅==>93像素, PPI=90.486486486486
 * */


 //设置图像信息
 $this->info = array(
    'width'  => $info[0],
    'height' => $info[1],
    'type'   => image_type_to_extension($info[2], false),
    'mime'   => $info['mime'],
    //下面自带的方法获取长宽会窄一点，造成gif缩放错误
//            'width'  => $this->img->getImageWidth(),
//            'height' => $this->img->getImageHeight(),
//            'type'   => strtolower($this->img->getImageFormat()),
//            'mime'   => $this->img->getImageMimeType(),
);