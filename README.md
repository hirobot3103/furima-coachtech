# 実践学習ターム 模擬案件初級_フリマアプリ 

<img src='./doc/img/topimg.jpg'> 
 
## 概要 
- サービス名　；　coachtechフリマ
- 機能　　　　：　アイテムの出品と購入を行うためのフリマアプリ
- システム要件：　案件シート内の機能要件・非機能要件等記載
 
 
## 環境構築  
1. Dockerビルド
(1) 導入したいディレクトリへ移動し、githubからリポジトリを複製
```
git clone git@github.com:hirobot3103/furima-coachtech.git
```
(2) 個人が持つgithubアカウントでログインし、リモートリポジトリを作成
(3) (1)で作成したディレクトリへ移動し、現在のローカルリポジトリのデータをリモートリポジトリに反映させる。
```
git remote set-url origin 作成したリポジトリのurl
```
(4) 作成したリモートリポジトリに対し、最初のPUSHを行う。
```
git add .
git commit -m "リモートリポジトリの変更"
git push origin main
```

(2) 複製したリポジトリ内の src/.envファイルなどを編集していきます。
```

```


## ER図
- テーブル仕様書については、案件シート内に記載
<img src="./doc/img/erimg.jpg">




