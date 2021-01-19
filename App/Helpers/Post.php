<?php 
    class Post{
        public static function Title(){
            global $item;
            return $item->title;
        }

        public static function Content(){
            global $item;
            return $item->content;
        }

        public static function Summary(){
            global $item;
            return $item->summary;
        }

        public static function Slug(){
            global $item;
            return App::Setting('site_url') . 'post/' . $item->slug;
        }

        public static function Comments(){
            global $item;
            global $db;
            $comm = $db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY ID DESC');
            $comm->execute([$item->ID]);
            return $comm->fetchAll(PDO::FETCH_OBJ);
        }

        public static function Replies(){
            global $comment;
            global $db;
            $replies = $db->prepare('SELECT * FROM replies INNER JOIN admin WHERE comment_id = ? AND admin.ID = 1');
            $replies->execute([$comment->ID]);
            return $replies->fetchAll(PDO::FETCH_OBJ);
        }

        public static function Avatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ){
            $url = 'https://www.gravatar.com/avatar/';
            $url .= md5( strtolower( trim( $email ) ) );
            $url .= "?s=$s&d=$d&r=$r";
            if ( $img ) {
                $url = '<img src="' . $url . '"';
                foreach ( $atts as $key => $val )
                    $url .= ' ' . $key . '="' . $val . '"';
                $url .= ' />';
            }
            return $url;        
        }

        public static function AdminAvatar(){
            global $reply;
            return App::Setting('site_url') . 'Content/Uploads/' . $reply->avatar;
        }

        public static function PaginationLinks($page, $total, $url){
            $links = "";
            $links .= '<ul class="pagination justify-content-center pagination-sm pagination-general">';
            if ($total >= 1 && $page <= $total) {
                $active = $page == 1 ? 'active' : null;
                $links .= "<li class=\"page-item\"><a class=\"page-link {$active}\" href=\"{$url}?p=1\">1</a></li>";
                $i = max(2, $page - 5);
                if ($i > 2)
                    $links .= "<li class=\"page-item\"><span class=\"page-link\">...</span></li>";
                for (; $i < min($page + 6, $total); $i++) {
                    $active = $page == $i ? 'active' : null;
                    $links .= "<li class=\"page-item\"><a class=\"page-link {$active}\" href=\"{$url}?p={$i}\">{$i}</a></li>";
                }
                if ($i != $total){
                    $links .= "<li class=\"page-item\"><span class=\"page-link\">...</span></li>";
                }
                $lastActive = $page == $total ? 'active' : null;
                $links .= "<li class=\"page-item\"><a class=\"page-link {$lastActive}\" href=\"{$url}?p={$total}\">{$total}</a></li>";
            }
            $links .= '</ul>';
            return $links;        
        }        
    }