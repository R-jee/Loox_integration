<?php 
$Reviews_DATA = [];

            $xml_parseFile = simplexml_load_file('https://loox.io/admin/reviews/V1bTpmqDaj.43abe9a4f39570d0d2740bc1368fdc50/google-shopping.xml');
            if($xml_parseFile === false){
                echo "<script> alert('Error! loading xml'); </script>";
                foreach( libxml_get_errors() as $errors){
                    echo $errors-> message;
                }
            }else{
                $xml_Reviews_Array = json_decode (json_encode($xml_parseFile) , true );
                // print_r($xml_Reviews_Array);
                $temp_reviews_xml = $xml_Reviews_Array['reviews']['review'];
                // print_r($temp_reviews_xml);
                if(sizeof($temp_reviews_xml) > 0){
                    for ($i=0; $i < sizeof($temp_reviews_xml) ; $i++) { 
                        $reviewer_temp = array();
                        $reviewer_temp = array(

                            "review_id" => ( isset( $temp_reviews_xml[$i]['review_id'] ) ) ? $temp_reviews_xml[$i]['review_id'] : "" ,
                            "reviewer_name" => ( isset( $temp_reviews_xml[$i]['reviewer']['name'] ) ) ? $temp_reviews_xml[$i]['reviewer']['name'] : "" ,
                            "reviewer_message" => ( isset( $temp_reviews_xml[$i]['content'] ) ) ? $temp_reviews_xml[$i]['content'] : ""   ,
                            "reviewer_image" => ( isset( $temp_reviews_xml[$i]['reviewer_images'] ) ) ? $temp_reviews_xml[$i]['reviewer_images']['reviewer_image']['url'] : ""  ,
                            "review_url_page" => ( isset( $temp_reviews_xml[$i]['review_url'] ) ) ? $temp_reviews_xml[$i]['review_url'] : "",
                            "reviewer_given_ratings" => ( isset( $temp_reviews_xml[$i]['ratings'] ) ) ? $temp_reviews_xml[$i]['ratings']['overall'] : "" ,
                            "product_ids" => ( isset( $temp_reviews_xml[$i]['products'] ) ) ? json_encode( $temp_reviews_xml[$i]['products']['product']['product_ids'] ) : "" ,
                            "product_name" => ( isset( $temp_reviews_xml[$i]['products'] ) ) ? json_encode( $temp_reviews_xml[$i]['products']['product']['product_name'] ) : "" ,
                            "product_url" => ( isset( $temp_reviews_xml[$i]['products'] ) ) ? json_encode( $temp_reviews_xml[$i]['products']['product']['product_url'] ) : "" ,
                            "review_timestamp" => ( isset( $temp_reviews_xml[$i]['review_timestamp'] ) ) ? $temp_reviews_xml[$i]['review_timestamp'] : "" ,
                        );
                        // print_r( $reviewer_temp );
                        $Reviews_DATA[$i] = ( $reviewer_temp );
                    }
                    echo  json_encode( $Reviews_DATA );

                }else{
                    echo "No data Found!";
                }

            }

?>
