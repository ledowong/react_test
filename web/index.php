<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>react-test</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <style>
      .row>div{
        padding:5px;
      }
      img{
        width: 100%;
      }
    </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.1/react.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.1/react-dom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="container-fluid" id="photos">
    </div>

    <script type="text/babel">
      var Photo = React.createClass({
        render: function() {
          return (
            <div className="col-xs-4 col-sm-2">
              <a href={this.props.photo.link} target="_blank">
                <img src={this.props.photo.images.thumbnail.url} title={this.props.photo.caption.text} className="img-thumbnail img-responsive"/>
              </a>
            </div>
          );
        }
      });

      var PhotoBox = React.createClass({
        getInitialState: function() {
          return {photos: []};
        },
        componentDidMount: function() {
          $.ajax({
            url: this.props.url,
            dataType: 'json',
            cache: false,
            success: function(data) {
              this.setState({photos: data.data});
            }.bind(this),
            error: function(xhr, status, err) {
              console.error(this.props.url, status, err.toString());
            }.bind(this)
          });
        },
        render: function() {
          var photoNodes = this.state.photos.map(function(photo) {
            return (
              <Photo photo={photo} key={photo.id}/>
            );
          });
          return (
            <div className="row">
              {photoNodes}
            </div>
          );
        }
      });

      ReactDOM.render(
        <PhotoBox url="https://api.instagram.com/v1/media/popular?client_id=9c8dbb5209cd467e9ddb28ffc8a7aa4a&callback=?"/>,
        document.getElementById('photos')
      );
    </script>
  </body>
</html>
