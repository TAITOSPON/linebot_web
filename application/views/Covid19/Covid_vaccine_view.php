<!DOCTYPE html>
<html>
<head>
<title>TOAT</title> 
<meta name="viewport" content="initial-scale=1" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">


<link rel="stylesheet" href="<?=base_url()?>assets/css/flex2html.css">
<script type="text/javascript" src="<?=base_url()?>assets/js/flex2html.min.js"></script>


<style>
.center {
  margin: auto;
  width: 50%;
}

</style>

</head>
    <body>
      
         

    
            <div class="chatbox" style="font-family: 'Kanit', 'Prompt', sans-serif;">
        
                <div id="flex2"></div>
            </div>
        

            <script>

           
                flex2html(
                    "flex2",
                    {
                        "type":"flex",
                        "altText":"Flex Message",
                        "contents":{
                            "type":"carousel",
                            "contents":[
                                {
                                    "type":"bubble",
                                    "size":"giga",
                                    "header":{
                                        "type":"box",
                                        "layout":"vertical",
                                        "contents":[
                                            {
                                            "type":"box",
                                            "layout":"vertical",
                                            "contents":[
                                                {
                                                    "type":"text",
                                                    "text":"นัดฉีดวัคซีน (เข็มที่ 2)",
                                                    "color":"#ffffff",
                                                    "size":"xl"
                                                },
                                                {
                                                    "type":"text",
                                                    "text":"วันที่ : <?php echo $data['second']?> ",
                                                    "color":"#ffffff",
                                                    "size":"sm",
                                                    "flex":4
                                                }
                                            ]
                                            },
                                            {
                                            "type":"box",
                                            "layout":"vertical",
                                            "contents":[
                                                {
                                                    "type":"text",
                                                    "text":"",
                                                    "color":"#ffffff66",
                                                    "size":"sm"
                                                },
                                                {
                                                    "type":"text",
                                                    "text":"<?php echo $data['user_name'] ?>",
                                                    "color":"#ffffff",
                                                    "size":"xl",
                                                    "flex":4,
                                                    "weight":"bold"
                                                }
                                            ]
                                            }
                                        ],
                                        "paddingAll":"20px",
                                        "backgroundColor":"#415e3e",
                                        "spacing":"md",
                                        "height":"154px",
                                        "paddingTop":"22px"
                                    },
                                    "hero":{
                                        "type":"image",
                                        "url":"https://scontent.fbkk7-2.fna.fbcdn.net/v/t1.6435-9/167258776_837023323694806_5324680110308309427_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=973b4a&_nc_ohc=avJfTmaIGwAAX9RCiJ-&_nc_ht=scontent.fbkk7-2.fna&oh=92cc72e1eda55b114032f55e3df6918f&oe=614C8A7E",
                                        "size":"full",
                                        "aspectRatio":"10:3",
                                        "aspectMode":"fit"
                                    },
                                    "body":{
                                        "type":"box",
                                        "backgroundColor":"#d6dfcb",
                                        "layout":"vertical",
                                        "contents":[
                                            {
                                            "type":"text",
                                            "text":"โรงพยาบาลสวนเบญจกิติฯ",
                                            "color":"#000000",
                                            "size":"sm"
                                            },
                                            {
                                            "type":"box",
                                            "layout":"horizontal",
                                            "contents":[
                                                {
                                                    "type":"text",
                                                    "text":"เข็มที่ 1",
                                                    "size":"sm",
                                                    "gravity":"center"
                                                },
                                                {
                                                    "type":"box",
                                                    "layout":"vertical",
                                                    "contents":[
                                                        {
                                                        "type":"filler"
                                                        },
                                                        {
                                                        "type":"box",
                                                        "layout":"vertical",
                                                        "contents":[
                                                            
                                                        ],
                                                        "cornerRadius":"30px",
                                                        "height":"12px",
                                                        "width":"12px",
                                                        "borderColor":"#6486E3",
                                                        "borderWidth":"2px"
                                                        },
                                                        {
                                                        "type":"filler"
                                                        }
                                                    ],
                                                    "flex":0
                                                },
                                                {
                                                    "type":"text",
                                                    "text":"<?php echo $data['frist'] ?> <?php echo $data['vac_name'] ?> ",
                                                    "gravity":"center",
                                                    "flex":4,
                                                    "size":"sm"
                                                }
                                            ],
                                            "spacing":"lg",
                                            "cornerRadius":"30px",
                                            "margin":"xl"
                                            },
                                            {
                                            "type":"box",
                                            "layout":"horizontal",
                                            "contents":[
                                                {
                                                    "type":"box",
                                                    "layout":"baseline",
                                                    "contents":[
                                                        {
                                                        "type":"filler"
                                                        }
                                                    ],
                                                    "flex":1
                                                },
                                                {
                                                    "type":"box",
                                                    "layout":"vertical",
                                                    "flex":"0",
                                                    "contents":[
                                                        {
                                                        "type":"box",
                                                        "layout":"horizontal",
                                                        "contents":[
                                                            {
                                                                "type":"filler"
                                                            },
                                                            {
                                                                "type":"box",
                                                                "layout":"vertical",
                                                                "flex":"0",
                                                                "contents":[
                                                                    
                                                                ],
                                                                "width":"2px",
                                                                "backgroundColor":"#6486E3"
                                                            },
                                                            {
                                                                "type":"filler"
                                                            }
                                                        ],
                                                        "flex":1
                                                        }
                                                    ],
                                                    "width":"12px"
                                                },
                                                {
                                                    "type":"text",
                                                    "text":"<?php echo $data['vac_lot_detail'] ?> ",
                                                    "gravity":"center",
                                                    "flex":4,
                                                    "size":"xs",
                                                    "wrap":true,
                                                    "color":"#8c8c8c"
                                                }
                                            ],
                                            "spacing":"lg",
                                            "height":"64px"
                                            },
                                            {
                                            "type":"box",
                                            "layout":"horizontal",
                                            "contents":[
                                                {
                                                    "type":"box",
                                                    "layout":"horizontal",
                                                    "contents":[
                                                        {
                                                        "type":"text",
                                                        "text":"เข็มที่ 2",
                                                        "gravity":"center",
                                                        "size":"sm"
                                                        }
                                                    ],
                                                    "flex":1
                                                },
                                                {
                                                    "type":"box",
                                                    "layout":"vertical",
                                                    "contents":[
                                                        {
                                                        "type":"filler"
                                                        },
                                                        {
                                                        "type":"box",
                                                        "layout":"vertical",
                                                        "contents":[
                                                            
                                                        ],
                                                        "cornerRadius":"30px",
                                                        "width":"12px",
                                                        "height":"12px",
                                                        "borderWidth":"2px",
                                                        "borderColor":"#EF454D"
                                                        },
                                                        {
                                                        "type":"filler"
                                                        }
                                                    ],
                                                    "flex":0
                                                },
                                                {
                                                    "type":"text",
                                                    "text":"<?php echo $data['second']?> <?php echo $data['vac_name'] ?>",
                                                    "gravity":"center",
                                                    "flex":4,
                                                    "size":"sm"
                                                }
                                            ],
                                            "spacing":"lg",
                                            "cornerRadius":"30px"
                                            }
                                        ]
                                    }
                                },

                                {
                                    "type":"bubble",
                                    "body":{
                                    "type":"box",
                                    "layout":"vertical",
                                    "contents":[
                                        {
                                            "type":"image",
                                            "url":"https://scontent.fbkk7-2.fna.fbcdn.net/v/t1.6435-9/p960x960/238850943_919612405435897_5765476593932228418_n.png?_nc_cat=110&ccb=1-5&_nc_sid=36a2c1&_nc_ohc=Gif2LhbB8dEAX-bSBkV&_nc_ht=scontent.fbkk7-2.fna&oh=aa01f3f495182be934180c325e435802&oe=614BCB55",
                                            "size":"full",
                                            "aspectMode":"cover",
                                            "aspectRatio":"2:3",
                                            "gravity":"top"
                                        },
                                   
                                        {
                                            "type":"box",
                                            "layout":"vertical",
                                            "contents":[
                                                {
                                                "type":"text",
                                                "text":"NOTICE",
                                                "color":"#ffffff",
                                                "align":"center",
                                                "size":"xs",
                                                "offsetTop":"3px"
                                                }
                                            ],
                                            "position":"absolute",
                                            "cornerRadius":"20px",
                                            "offsetTop":"18px",
                                            "backgroundColor":"#ff334b",
                                            "offsetStart":"18px",
                                            "height":"25px",
                                            "width":"53px"
                                        }
                                    ],
                                    "paddingAll":"0px"
                                    }
                                }
                            ]
                        }
                    }
                )

                
            </script>

      

           
   

      
      
    </body>
</html>
