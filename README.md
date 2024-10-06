# Vite WordPress 開発環境

Vite × WordPress 大規模静的サイト開発環境

## 必要条件

- Node.js (v14 以上)
- npm または yarn
- ローカルの WordPress 開発環境（例：Local by Flywheel, XAMPP, MAMP など）

## セットアップ手順

1. このリポジトリをクローンまたはダウンロードします：

   ```
   git clone https://github.com/your-username/vite-wordpress.git
   ```

2. プロジェクトディレクトリに移動します：

   ```
   cd vite-wordpress
   ```

3. 依存関係をインストールします：

   ```
   npm install
   ```

4. `bs-config.js` ファイルを開き、`proxy` の値をあなたのローカル WordPress サイトの URL に変更します：

   ```javascript
   module.exports = {
     proxy: "http://your-local-wordpress-site.local",
     files: ["./dist/**/*.css", "./dist/**/*.js", "./**/*.php"],
   };
   ```

5. `functions.php` ファイルを開き、開発モードが有効(true)になっていることを確認します：
   ```php
   // 開発中はtrue、本番ビルド時はfalseにする
   define('IS_VITE_DEVELOPMENT', true);
   ```

## 開発モードの使用方法

1. 最初のターミナルで Vite 開発サーバーを起動します：

   ```
   npm run dev
   ```

2. 新しいターミナルウィンドウを開き、BrowserSync を起動します：

   ```
   npm run serve
   ```

3. ブラウザが自動的に開き、ローカルの WordPress サイトが表示されます。
   変更を加えると、ブラウザが自動的に更新されます。

## 本番ビルドの作成

1. `functions.php` ファイルを開き、開発モードを無効(false)にします：

   ```php
   // 開発中はtrue、本番ビルド時はfalseにする
   define('IS_VITE_DEVELOPMENT', false);
   ```

2. 以下のコマンドを実行して、本番用のアセットをビルドします：

   ```
   npm run build
   ```

3. `dist` ディレクトリに生成されたファイルを確認します。

## プロジェクト構造

```
vite-wordpress/
├── src/
│   ├── js/
│   │   ├── main.js
│   │   └── components/
│   │       └── example.js
│   └── scss/
│       ├── style.scss
│       ├── components/
│       │   └── _buttons.scss
│       ├── foundation/
│       │   ├── _reset.scss
│       │   └── _variables.scss
│       ├── global/
│       │   └── _typography.scss
│       ├── layout/
│       │   ├── _header.scss
│       │   └── _footer.scss
│       ├── project/
│       │   └── _home.scss
│       └── utility/
│           └── _helpers.scss
├── dist/           # ビルド後のファイルが出力されるディレクトリ
├── functions.php   # WordPressの関数ファイル（Viteの設定を含む）
├── index.php       # メインのテーマファイル
├── style.css       # テーマ情報を含むCSSファイル
├── vite.config.js  # Viteの設定ファイル
├── package.json    # プロジェクトの依存関係とスクリプト
└── bs-config.js    # BrowserSyncの設定ファイル
```

### SCSS ディレクトリ構造の説明

- `components/`: 再利用可能な UI 要素のスタイル（ボタン、フォーム要素など）
- `foundation/`: ベースとなるスタイル（リセット CSS、変数定義など）
- `global/`: グローバルに適用されるスタイル（タイポグラフィなど）
- `layout/`: サイトの主要な構造部分のスタイル（ヘッダー、フッター、サイドバーなど）
- `project/`: プロジェクト固有のページやセクションのスタイル
- `utility/`: ユーティリティクラスや補助的なスタイル

`style.scss`ファイルでこれらのパーシャルファイルをインポートし、最終的な CSS を生成します。

## 注意事項

- 開発時は `functions.php` の `IS_VITE_DEVELOPMENT` を `true` に、本番環境では `false` に設定してください。
- 新しい JavaScript ファイルを追加した際は、`main.js` でインポートしてください。
- `bs-config.js` のプロキシ URL は、あなたのローカル環境に合わせて必ず変更してください。

## トラブルシューティング

- ホットリロードが機能しない場合は、ブラウザのキャッシュをクリアし、両方のサーバー（`npm run dev` と `npm run serve`）を再起動してみてください。
- 本番ビルド後に変更が反映されない場合は、ブラウザのキャッシュをクリアしてください。
