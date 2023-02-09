<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localization Finder</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- 
    import location
    include folder
    exclude folder
    identifier has many
    json or array
    file name
    export location
     -->
    <div class="main">
        <div class="container">
            <div class="header">
                <h3>Localization Finder</h3>
            </div>
            <div class="localization-form">
                <form action="">
                    <div class="form-group">
                        <label for="">Import Location</label>
                        <input type="text" name="" id="" placeholder="F:\package-development\localization-finder">
                    </div>
                    <div class="form-group">
                        <label for="">Identifier</label>
                        <input type="text" name="" id="" placeholder="trans('text')">
                        <label class="note" for="">Ex: lang('text') or __('text') or __("text") or trans("text")</label>
                        <label class="note" for="">Note: Identifier must include <span>text</span></label>
                    </div>
                    <div class="form-group">
                        <label for="">Include Directory</label>
                        <input type="text" name="" id="" placeholder="app">
                    </div>
                    <div class="form-group">
                        <label for="">Exclude Directory</label>
                        <input type="text" name="" id="" placeholder="vendor">
                    </div>
                    <div class="form-group">
                        <label for="">Export Location</label>
                        <input type="text" name="" id="" placeholder="F:\package-development\directory">
                    </div>
                    <div class="form-group">
                        <div class="radio">
                            <div class="radio-box">
                                <input type="radio" name="format" id="json" value="json" checked>
                                <label for="json">Json</label>
                            </div>
                            <div class="radio-box">
                                <input type="radio" name="format" id="array" value="array">
                                <label for="array">Array</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">File Name</label>
                        <input class="filename" type="text" name="" id="" value="en">
                        <button class="separator">.</button>
                        <input class="extension" type="text" name="" id="" value="json">
                    </div>

                    <div class="process">
                        <button type="button" name="" id="start_process">Start Processing</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="containers">
            <div class="circular-progress">
                <span class="progress-value">0%</span>
            </div>

            <span class="text">0 / 0</span>
        </div>
    </div>

    <script src="./assets/js/script.js"></script>
</body>

</html>