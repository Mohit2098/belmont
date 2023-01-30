jQuery(document).ready(function($) {

    function isGutenberg() {
        return ($('.block-editor-writing-flow').length > 0);
    }

    function checkImageReturnWarningMessageOrEmpty() {
        if (isGutenberg()) {
            var $img = $('.editor-post-featured-image').find('img');
        } else {
            var $img = $('#postimagediv').find('img');
        }
        if ($img.length === 0) {
            return passedFromServer.jsWarningHtml;
        }
        return '';
    }

    function disablePublishAndWarn(message) {
        createMessageAreaIfNeeded();
        $('#nofeature-message').addClass("error")
            .html('<p>'+message+'</p>');
        if (isGutenberg()) {
            $('.editor-post-publish-panel__toggle').attr('disabled', 'disabled');
        } else {
            $('#publish').attr('disabled','disabled');
        }
    }

    function clearWarningAndEnablePublish() {
        $('#nofeature-message').remove();
        if (isGutenberg()) {
            $('.editor-post-publish-panel__toggle').removeAttr('disabled');
        } else {
            $('#publish').removeAttr('disabled');
        }
    }

    function createMessageAreaIfNeeded() {
        if ($('body').find("#nofeature-message").length === 0) {
            if (isGutenberg()) {
                $('.components-notice-list').append('<div id="nofeature-message"></div>');
            } else {
                $('#post').before('<div id="nofeature-message"></div>');
            }
        }
    }

    function detectWarnFeaturedImage() {
        if (checkImageReturnWarningMessageOrEmpty()) {
            disablePublishAndWarn(checkImageReturnWarningMessageOrEmpty());
        } else {
            clearWarningAndEnablePublish();
        }
    }

    detectWarnFeaturedImage();
    setInterval(detectWarnFeaturedImage, 800);

});


const el = wp.element.createElement;
const withState = wp.compose.withState;
const withSelect = wp.data.withSelect;
const withDispatch = wp.data.withDispatch;

wp.hooks.addFilter(
    'editor.PostFeaturedImage',
    'enchance-featured-image/disable-featured-image-control',
    wrapPostFeaturedImage
);

function wrapPostFeaturedImage( OriginalComponent ) {
    return function( props ) {
        return (
            el(
                wp.element.Fragment,
                {},
                '',
                el(
                    OriginalComponent,
                    props
                ),
                el(
                    'strong', null, passedFromServer.jsMsg
                ),
                el(
                    'hr'
                ),
                el(
                    composedCheckBox
                )
            )
        );
    }
}
class CheckBoxCustom extends React.Component {
    render() {
        const {
            meta,
            updateDisableFeaturedImage,
        } = this.props;

        return (
            el(
                wp.components.CheckboxControl,
                {
                    heading: "",
                    label: "Hide featured image",
                    help: "Checking this will hide the featured image in frontend",
                    checked: meta.disable_featured_image,
                    onChange:
                        ( value ) => {
                            this.setState( { isChecked: value } );
                            updateDisableFeaturedImage( value, meta );
                        }
                }
            )
        )
    }
}
const composedCheckBox = wp.compose.compose( [
    withState( ( value ) => { isChecked: value } ),
    withSelect( ( select ) => {
        const currentMeta = select( 'core/editor' ).getCurrentPostAttribute( 'meta' );
        const editedMeta = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
        return {
            meta: { ...currentMeta, ...editedMeta },
        };
    } ),
    withDispatch( ( dispatch ) => ( {
        updateDisableFeaturedImage( value, meta ) {
            meta = {
                ...meta,
                disable_featured_image: value,
            };
            dispatch( 'core/editor' ).editPost( { meta } );
        },
    } ) ),
] )( CheckBoxCustom );