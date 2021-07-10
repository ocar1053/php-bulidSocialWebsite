<br />
<p align="center">

  <h3 align="center">PHP社交平台之建置</h3>

  <p align="center">
        建置結合天氣功能的社交平台
    <br />
    <a href="https://github.com/ocar1053/php-bulidSocialWebsite"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://webnccu2021.000webhostapp.com/finalproject/pancebook/dist//login.php">View Demo</a>
    ·
    <a href="https://github.com/ocar1053/php-bulidSocialWebsite/issues">Report Bug</a>
    ·
    <a href="https://github.com/ocar1053/php-bulidSocialWebsite/pulls">Request Feature</a>
  </p>
</p>

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>目錄</summary>
  <ol>
    <li>
      關於專案
      <ul>
        <li>使用工具</li>
      </ul>
    </li>
    </li>
    <li>主要功能展示
    <ul>
        <li>個人檔案</li>
        <li>開放討論區</li>
        <li>按讚回饋</li>
        <li>好友列表</li>
        <li>私密聊天室</li>
        <li>天氣與對應背景圖片</li>
      </ul>
    </li>
    <li>使用技術</li>
    <li>貢獻者</li>
    <li>聯絡資料</li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## 關於專案

![Product Name Screen Shot][product-screenshot]

利用 php 和 javascript 建立結合天氣功能的社交平台，旨在建立人與人之間的情感聯繫，平台內功能具有討論留言區，檔案上傳，按讚點擊功能，好友功能，私密聊天室與背景圖片查詢天氣響應功能。

#### 使用工具

-   [JQuery](https://jquery.com)
-   [PHP](https://www.php.net/)
-   [phpMyAdmin](https://www.phpmyadmin.net/)
-   [MySQL](https://www.mysql.com/)
-   [000webhost](https://www.000webhost.com/)

<!-- GETTING STARTED -->

## 功能展示

個人主頁，提供檔案上傳，天氣查詢與個人編輯。

![Product Name Screen Shot][personal-screenshot]

<br>
<br>

提供分類看板與文章討論功能，且支持編輯與刪除使用者自己的留言，提供使用者間互動的功能。

![Product Name Screen Shot][board-screenshot]

<br>
<br>

提供評論討論主題之點讚機制，將點擊的數據存入資料庫進行保存，提供使用者間互動的功能。

![Product Name Screen Shot][ike-screenshot]

<br>
<br>

本網站具有好友添加系統，能在按鈕 friendlist 中確認好友狀態，且其提供他人主頁的連結。

![Product Name Screen Shot][friendlist-screenshot]

<br>
<br>

以好友添加系統的基礎之上，利用配對函數建立好友之間的私密聊天室，提供私密交流之平台。

![Product Name Screen Shot][chatroom-screenshot]

<br>
<br>

各人主頁的背景圖片將會隨著天氣查詢的地點而改變，此背後的原理是藉由串接圖庫 api，在查詢天氣的同時依照搜索詞搜尋當地圖片

![Product Name Screen Shot][weather-screenshot]

## 使用技術

-   jQuery AJAX
-   PDO
-   OpenWeatherMap

## 貢獻者

-   UIdesign - 江曉陽
-   部分介面調整美化 - 林韋君

## 聯絡資料

謝頤賢 - [謝頤賢臉書](https://www.facebook.com/profile.php?id=100002653454736) - ocar8951@gmail.com

Github Link: [https://github.com/ocar1053](https://github.com/ocar1053)

[product-screenshot]: images/socialmain.png
[personal-screenshot]: images/personalpage.png
[board-screenshot]: images/board.png
[ike-screenshot]: images/like.png
[weather-screenshot]: images/weather.png
[friendlist-screenshot]: images/firendlist.png
[chatroom-screenshot]: images/chatroom.png
