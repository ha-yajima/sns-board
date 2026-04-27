<?php
require('dbconnect.php');
session_start();

if (isset($_SESSION['id'])){
    $id = $_REQUEST['id'] ?? 0;
    $member_id = $_SESSION['id'];

    // 1. 削除対象の投稿を取得（作成日と親IDを確認するため）
    $messages = $db->prepare('SELECT * FROM posts WHERE id=?');
    $messages->execute(array($id));
    $message = $messages->fetch();

    // 自分の投稿であることを確認
    if ($message && $message['member_id'] == $member_id){
        
        $post_date = date('Y-m-d', strtotime($message['created']));
        $today = date('Y-m-d');

        // 2. ランキングデータの更新
        if ($post_date === $today) {
            // 【今日】の投稿を消す場合
            $update_ranking = $db->prepare("
                UPDATE ranking
                SET points = points - 5,
                    post_count = post_count - 1
                WHERE member_id = ? AND last_post_date = ?
            ");
            $update_ranking->execute(array($member_id, $today));
        } else {
            // 【昨日以前】の投稿を消す場合
            $update_ranking = $db->prepare("
                UPDATE ranking
                SET points = points - 5
                WHERE member_id = ?
            ");
            $update_ranking->execute(array($member_id));
        }

        // 3. 【戻り先の判定用】親か子か記録しておく
        $redirect_id = $message['reply_post_id'];

        // 4. 投稿を削除
        $del = $db->prepare('DELETE FROM posts WHERE id=?');
        $del->execute(array($id));

        // 5. 【戻り先の道理】
        if ($redirect_id == 0) {
            // 親を消した場合は、スレッド自体がなくなるので一覧へ
            header('Location: index.php');
        } else {
            // 子を消した場合は、元のスレッド（親の画面）へ戻る
            header('Location: view.php?id=' . $redirect_id);
        }
        exit();
    }
}

header('Location: index.php');
exit();
?>