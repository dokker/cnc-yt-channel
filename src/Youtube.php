<?php
    namespace cncYTC;
    class Youtube {
        private $channelId;
        private $apiKey;

        function __construct(){
            $config = include(CNC_YTC_PROJECT_PATH . CNC_YTC_DS . 'config.php');
            if ($config) {
                $this->channelId = $config['channel_id'];
                $this->apiKey = $config['api_key'];
            }
        }

        /**
         * Get video code
         * @param string $id
         * @return string
         */
        function getCode($id){
            $idParts = explode('/',$id);

            return end($idParts);
        }

        /**
         * Get video embed code markup
         * @param string $id Video id url
         * @return string
         */
        function getEmbedCode($id){
            $idParts = explode('/',$id);

            $embed = str_replace('code',end($idParts),'<iframe width="450" height="255" src="//www.youtube.com/embed/code" style="border: none;" allowfullscreen></iframe>');

            return $embed;
        }

        /**
         * Get data for videos
         * @return array Video data
         */
        function getEntries(){
            $url = 'https://www.googleapis.com/youtube/v3/search?key='.$this->apiKey.'&channelId='.$this->channelId.'&part=snippet,id&order=date&maxResults=50';
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $rs = curl_exec($ch);

            $entries = array();
            $i       = 0;

            if (!empty($rs)){
                $feed = json_decode($rs);

                if (is_array($feed->items)){
                    foreach ($feed->items as $entry){
                      if (!empty($entry->id->videoId)){
                        $entries[$i]['code']        = $entry->id->videoId;
                        $entries[$i]['published']   = substr(str_replace('-','.',str_replace('T',' ',$entry->snippet->publishedAt)),0,16);
                        $entries[$i]['thumbnail']   = $entry->snippet->thumbnails->default->url;
                        $entries[$i]['link']        = "https://www.youtube.com/watch?v=".$entry->id->videoId;
                        $entries[$i]['title']       = $entry->snippet->title;
                        $entries[$i]['embed']       = $this->getEmbedCode($entry->id->videoId);

                        $i++;
                      }
                    }
                }
            }

            return $entries;
        }

        /**
         * Generate videos list markup
         * @param  int $item_num Number of videos
         * @return string           HTML markup
         */
        function getHTML($item_num){
          $videos = $this->getVideos();
          $videoChannelHTML = '';
          $i = 0;

          if (is_array($videos['videos'])){

            foreach (array_slice($videos['videos'], 0, $item_num) as $video){
              $videoChannelHTML .= '<div class="video-list-item '.($video['code'] == $videos['featured']['code']?'featured':'').'" data-video-id="'.$video['code'].'">
                <div class="image"><img src="'.$video['thumbnail'].'" width="120" height="90" alt="'.esc_attr($video['title']).'" /></div>
                <div class="data">
                <span class="title">'.$video['title'].'</span>
                </div>
                </div>';

$i++;
            }
          }
          return $videoChannelHTML;
        }

        /**
         * Generate featured video markup
         * @param  int $id Video ID
         * @return string     HTML markup
         */
        function getFeaturedHTML($id){
            $video = $this->getFeaturedVideo($id);

            $html  = $video['embed'];

            return $html;
        }

        function getFeaturedId() {
            $videos = $this->getEntries();
                    echo '<h2>Contents of $videos</h2>';
                    echo '<pre>';
                    print_r($videos);
                    echo '</pre>';
                    die();
        }        

        /**
         * Get video data
         * @param  int $id Video ID
         * @return array     Video data
         */
        function getFeaturedVideo($id){
            $videos = $this->getEntries();

            if (!$id){
                return $videos[0];
            }
            else{
                if (is_array($videos)){
                    foreach ($videos as $video){
                        if ($video['code'] == $id)
                            return $video;
                    }
                }
            }

            return $videos[0];
        }

        /**
         * Get video list
         * @return array Video list
         */
        function getVideos(){
            $videoChannel = array();

            $i = 0;

            if ($entries = $this->getEntries()){
                $videoChannel['featured'] = $entries[0];
                $videoChannel['videos']  = $entries;
            }

            return $videoChannel;
        }

        /**
         * Read channel XML data
         * @param  string $channelName Name of channel
         * @return string|bool              XML data or false
         */
        function getXML($channelName){
            $url = 'http://gdata.youtube.com/feeds/api/users/'.$channelName.'/uploads';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if ($xml = curl_exec($ch)){
                curl_close($ch);
                return $xml;
            }
            else{
                curl_close($ch);
                return false;
            }
        }


    }
