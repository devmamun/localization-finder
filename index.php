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
    <div class="main">
        <div class="container">
            <div class="header">
                <h3>Localization Finder</h3>
            </div>
            <div class="localization-form">
                <form action="">
                    <div class="form-group">
                        <label for="">Import Location*</label>
                        <input type="text" name="import_path" id="" placeholder="F:\package-development\localization-finder">
                    </div>
                    <div class="form-group">
                        <label for="">Identifier*</label>
                        <input type="text" name="identifier" id="" placeholder="trans('text')">
                        <label class="note" for="">Ex: lang('text') or __('text') or trans('text')</label>
                        <label class="note" for="">Note: Multiple identifier can be used with comma(',') separator</label>
                    </div>
                    <div class="form-group">
                        <label for="">Include Directory</label>
                        <input type="text" name="" id="" placeholder="app" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Exclude Directory</label>
                        <input type="text" name="" id="" placeholder="vendor" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Export Location*</label>
                        <input type="text" name="export_path" id="" placeholder="F:\package-development\directory">
                    </div>
                    <div class="form-group">
                        <div class="radio">
                            <div class="radio-box">
                                <input type="radio" name="format" id="json" value="json" checked>
                                <label for="json">Json</label>
                            </div>
                            <div class="radio-box">
                                <input type="radio" name="format" id="array" value="array" disabled>
                                <label for="array">Array</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">File Name</label>
                        <input class="filename" type="text" name="export_file_name" id="" value="en">
                        <button class="separator">.</button>
                        <input class="extension" type="text" name="export_file_extension" id="" value="json">
                    </div>

                    <div class="process">
                        <button type="button" name="execute" id="start_process">Start Processing</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="progress_bar" class="containers hidden">
            <div class="circular-progress">
                <span class="progress-value">0%</span>
            </div>

            <span class="text">0 / 0</span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>