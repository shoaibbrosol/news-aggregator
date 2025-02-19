<h1>News Aggregator Backend (Laravel)</h1>
 This is a Laravel-based news aggregator backend that fetches news articles from multiple sources,
 stores them in a database, and provides API endpoints for a frontend application.
 
 <h1>Features</h1>
 Fetches news articles from NewsAPI, The Guardian, and The New York Times.
 
 Stores articles in a MySQL database.
 
 Provides REST API endpoints for retrieving, filtering, and searching news.
 
 Scheduled task to update articles regularly.
 
 <h1>Installation Guide</h1>
 <h2>Clone the Repository</h2>
 git clone https://github.com/yourusername/news-aggregator.git
 
 cd news-aggregator
 
 <h2>Install Dependencies</h2>
 composer install
 <h2>Set Up Environment Variables</h2>
 Rename .env.example to .env and configure the database:
 
 DB_CONNECTION=mysql
 
 DB_HOST=127.0.0.1
 
 DB_PORT=3306
 
 DB_DATABASE=news_aggregator
 
 DB_USERNAME=root
 
 DB_PASSWORD=
 
 Set API keys for news sources:
 
 NEWSAPI_KEY=your_newsapi_key
 
 GUARDIAN_API_KEY=your_guardian_key
 
 NYTIMES_API_KEY=your_nytimes_key
 
 <h2>Run Migrations</h2>
  php artisan migrate
  <h2>Start the Server</h2>
  php artisan serve
  <h2>Fetching News Articles</h2>
  php artisan news:fetch
  or
  schedule this automatically
  php artisan schedule:work
  <h1>API Endpoints</h1>
  <h2>Get All Articles</h2>
  <p>GET /api/articles</p>
  <h3>Optional Filters:</h3>
  <table>
  <th>
  <tr>
  <td>Parameter</td>
  <td>Description</td>
  <td>Example</td>
  </tr>
  </th>
  <tbody>
  <tr>
  <td>category</td>
  <td>Filter by category</td>
  <td>category=technology</td>
  </tr>
  <tr>
    <td>source</td>
    <td>Filter by news source</td>
    <td>source=NewsAPI</td>
    </tr>
    <tr>
      <td>author</td>
      <td>Filter by author name</td>
      <td>author=John Doe</td>
      </tr>
  </tbody>
  </table>
  <h4>Example Request:</h4>
  <p>GET /api/articles?category=technology&source=The Guardian</p>
  <h3>Search Articles</h3>
  <p>GET /api/articles/search?q=bitcoin</p>
 
