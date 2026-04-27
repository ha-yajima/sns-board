<?php
// ITmediaのニュースRSSを取得
$rss_url = "https://rss.itmedia.co.jp/rss/2.0/news_bursts.xml";
$rss = @simplexml_load_file($rss_url);

$news_list = [];
if ($rss) {
    foreach ($rss->channel->item as $item) {
        $news_list[] = [
            'title' => (string)$item->title,
            'link'  => (string)$item->link,
        ];
        if (count($news_list) >= 9) break;
    }
}

// 雲の色パターン
$cloud_colors = ['pink', 'yellow', 'blue'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>くもっち・にゅーす</title>
    <style>
        body {
            background-color: #f0faff; /* 淡い空色 */
            margin: 0;
            font-family: 'Hiragino Maru Gothic ProN', sans-serif;
            padding-bottom: 100px;
        }

        .header {
            text-align: center;
            padding: 40px;
        }
        .header h1 {
            color: #55acee;
            font-size: 2.5rem;
            text-shadow: 2px 2px 0 white;
        }

        /* 3列のグリッド */
        .magazine-grid {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px 30px;
            padding: 0 20px;
        }

        /* ニュースユニット（雲＋ボックス） */
        .news-unit {
            display: flex;
            flex-direction: column;
            align-items: center;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.1));
        }

        /* 雲の画像エリア（ここにご用意された画像を当ててください） */
        .cloud-icon {
            width: 120px;
            height: 80px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            margin-bottom: -15px; /* ボックスと少し重ねる */
            z-index: 2;
        }

        /* 色ごとの雲（サンプルとして背景色を入れていますが、画像パスに書き換えてください） */
        .cloud-pink   { background-image: url('images/cloud_pink.png');   background-color: #ffc0cb; border-radius: 50px 50px 0 0; }
        .cloud-yellow { background-image: url('images/cloud_yellow.png'); background-color: #fffacd; border-radius: 50px 50px 0 0; }
        .cloud-blue   { background-image: url('images/cloud_blue.png');   background-color: #b0e0e6; border-radius: 50px 50px 0 0; }

        .news-box {
            background: #fff;
            padding: 25px 15px 15px;
            border-radius: 20px;
            width: 100%;
            min-height: 120px;
            text-align: center;
            border: 4px solid #fff;
            box-sizing: border-box;
            z-index: 1;
        }

        .news-title {
            font-size: 0.9rem;
            line-height: 1.4;
            color: #444;
            font-weight: bold;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-link {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.8rem;
            color: #55acee;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
        }
        .btn-back {
            background: #fff;
            padding: 10px 30px;
            border-radius: 30px;
            text-decoration: none;
            color: #55acee;
            box-shadow: 0 4px 0 #ddd;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>☁️ くもっち通信 ☁️</h1>
</div>

<div class="magazine-grid">
    <?php foreach ($news_list as $i => $news): 
        // 0, 1, 2, 0, 1, 2... と色をループさせる
        $color = $cloud_colors[$i % 3]; 
    ?>
    <div class="news-unit">
        <div class="cloud-icon cloud-<?php echo $color; ?>"></div>
        
        <div class="news-box">
            <div class="news-title"><?php echo htmlspecialchars($news['title']); ?></div>
            <a href="<?php echo $news['link']; ?>" target="_blank" class="btn-link">よむ ＞</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="footer">
    <a href="index.php" class="btn-back">お空にかえる</a>
</div>

</body>
</html>