{$message}
<form method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>{l s='Facebook Box'}</legend>

        <div class="opt clearfix">
            <label for="fbpage">{l s='Page'}</label>
            <div class="margin-form">
                <input id="fbpage" type="text" name="fbpage" value="{$fbpage}" style="width:250px" required>
            </div>
        </div>
        <div class="opt clearfix">
            <label for="width">{l s='Width'}</label>
            <div class="margin-form">
                <input id="width" type="text" name="width" value="{$width}" style="width:250px" required>
            </div>
        </div>
        <div class="opt clearfix">
            <label for="height">{l s='Height'}</label>
            <div class="margin-form">
                <input id="height" type="text" name="height" value="{$height}" style="width:250px">
            </div>
        </div>
        <div class="opt clearfix">
            <label for="colorscheme">{l s='Color scheme'}</label>
            <div class="margin-form">
                <select id="colorscheme" name="colorscheme">
                    <option value="light" {if $colorscheme=='light'}selected{/if}>light</option>
                    <option value="dark" {if $colorscheme=='dark'}selected{/if}>dark</option>
                </select>
            </div>
        </div>
        <div class="opt clearfix">
            <label for="show_header">{l s='Show Header'}</label>
            <div class="margin-form">
                <input id="show_header" type="checkbox" name="show_header" {if $show_header == 'on'}checked{/if}>
            </div>
        </div>
        <div class="opt clearfix">
            <label for="show_stream">{l s='Show Stream'}</label>
            <div class="margin-form">
                <input id="show_stream" type="checkbox" name="show_stream" {if $show_stream == 'on'}checked{/if}>
            </div>
        </div>
        <div class="opt clearfix">
            <label for="show_faces">{l s='Show Faces'}</label>
            <div class="margin-form">
                <input id="show_faces" type="checkbox" name="show_faces" {if $show_faces == 'on'}checked{/if}>
            </div>
        </div>
        <div class="opt clearfix">
            <label for="show_show_border">{l s='Show Border'}</label>
            <div class="margin-form">
                <input id="show_border" type="checkbox" name="show_border" {if $show_border == 'on'}checked{/if}>
            </div>
        </div>
        <div class="opt clearfix">
            <label for="appId">{l s='App ID'}</label>
            <div class="margin-form">
                <input id="appId" type="text" name="appId" value="{$appId}" style="width:250px">
            </div>
        </div>

        <div class="margin-form">
            <input class="button" type="submit" name="saveBtn" value="Save">
        </div>
    </fieldset>
</form>