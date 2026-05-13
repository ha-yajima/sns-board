# 掲示板型SNS（チーム制作）

## 概要
ユーザー登録、ログイン機能、画像投稿、およびリポスト機能を備えた、SNSプラットフォームです。
職業訓練の課題で、3人チームで制作しました。

<img width="1408" height="792" alt="SNS" src="https://github.com/user-attachments/assets/c893dce6-b69a-4007-9b10-626d9c801ae1" />


## 使用技術
- PHP 8.x (PDOを用いたセキュアなDB接続)
- MySQL (複雑なリレーションを持つDB設計)
- Ajax / Fetch API (非同期通信による「いいね」機能)
- HTML/CSS (レスポンシブ対応)
<img height="792" alt="SNSresponsive" src="https://github.com/user-attachments/assets/b3c8ad31-9e88-40f3-92e3-06827f504b99" />

  

## 注力したポイント
- **データの道理に基づくSQL:** 通常投稿とリポストを混合して表示するため、UNION句を用いた効率的なクエリを構築し、正確なデータ抽出を行いました。
- **非同期通信の導入:** 「いいね」ボタンにAjaxを採用。ページ全体をリロードせずにデータを更新することで、ユーザーにストレスを与えない設計にしました。
- **セキュリティ対策:** XSS対策（htmlspecialchars）やSQLインジェクション対策を徹底し、安全なシステム構築を学びました。
