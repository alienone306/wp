if (typeof SQ_DEBUG === 'undefined') var SQ_DEBUG = false;
var $sq_patterns = [];
(function ($) {
    $.fn.sq_patterns = function () {
        var $this = this;

        var settings = {
            field: false,
            patternid: 0,
            sq_pattern_icon: $('<div class="sq_pattern_icon" title="Click to edit/add more patterns"></div>'),
            sq_pattern_list: $('<div class="sq_pattern_list sq-col-sm-12 sq-mx-0 sq-px-0" style="display: none"><ul><li class="sq_nostyle">Click to insert a pattern:</li></ul></div>'),
        };

        if ($this.find('input[type=text]').length > 0) {
            settings.field = $this.find('input[type=text]');
        } else if ($this.find('textarea').length > 0) {
            settings.field = $this.find('textarea');
        }

        //Check if multiple snippets exists
        if ($this.data('patternid')) {
            settings.patternid = $this.data('patternid');
        }

        //Prevent multiple event listeners
        settings.sq_pattern_icon.off('click');
        settings.sq_pattern_list.find('li').off('click');

        $this.init = function () {

            if (!$this.find('.sq_pattern_list').length) {
                $this.append(settings.sq_pattern_list);

                var $snippet = $this.parents('.sq_blocksnippet:last');


                if (typeof $sq_patterns[settings.patternid] === 'undefined') {
                    $sq_patterns[settings.patternid] = $this.sq_getPatterns(
                        $snippet.find('input[name=sq_post_id]').val(),
                        $snippet.find('input[name=sq_term_id]').val(),
                        $snippet.find('input[name=sq_taxonomy]').val(),
                        $snippet.find('input[name=sq_post_type]').val()
                    );
                }


                $sq_patterns[settings.patternid].done(function (response) {
                    if (typeof response !== 'undefined') {
                        SQ_DEBUG && console.log(response);
                        if (typeof response.json !== 'undefined') {

                            $.sq_patterns_list = $.parseJSON(response.json);
                            for (var pattern in $.sq_patterns_list) {
                                if (pattern === '{{page}}' || ($.sq_patterns_list[pattern] !== "" && $.sq_patterns_list[pattern] !== null)) {
                                    $this.find('.sq_pattern_list').find('ul').append('<li data-pattern="' + pattern + '" data-value="' + $.sq_patterns_list[pattern] + '" title="' + $.sq_patterns_list[pattern] + '">' + pattern + '</li>');
                                }
                            }


                            //Call patterns to hover the selected ones
                            $this.selectPattern();

                        }
                    } else {
                        //location.reload();
                        SQ_DEBUG && console.log('no data received');
                    }
                });

            }
        };

        $this.listenIcon = function () {
            if (!$this.find('.sq_pattern_icon').length) {
                $this.append(settings.sq_pattern_icon);

                settings.sq_pattern_icon.on('click', function () {
                    settings.sq_pattern_list.toggle();

                    //If Pattern div is opened
                    //listen the click
                    if (settings.sq_pattern_list.is(':visible')) {
                        settings.sq_pattern_icon.addClass('sq_opened');

                        //check the field patterns first
                        $this.selectPattern();

                        //if the field is changed, call patterns
                        settings.field.off('change').on('change', function () {
                            $this.selectPattern();
                        });

                        //if a pattern is clicked, call patterns
                        settings.sq_pattern_list.find('li:not(.sq_nostyle)').off('click').on('click', function () {
                            $this.selectPattern($(this).html());
                        });

                    } else {
                        settings.sq_pattern_icon.removeClass('sq_opened');
                    }

                });
            }
        };

        $this.selectPattern = function (pattern) {
            var words = [];

            //are patterns, select them
            if (typeof pattern !== 'undefined') {
                var value = settings.field.val();
                //clear the white spaces
                if (pattern !== '{{sep}}' && value.indexOf(pattern) !== -1) {
                    value = value.replace(pattern, '').replace('  ', ' ').trim();
                } else {
                    if (value.split(" ").pop() !== pattern) {
                        value = (value + ' ' + pattern).trim();
                    } else {
                        value = value.substring(0, value.lastIndexOf(pattern)).trim();
                    }
                }
                settings.field.val(value);
            }

            if (settings.field.val().length > 1) {
                words = settings.field.val().split(' ');
            }

            //reset the selected patterns
            settings.sq_pattern_list.find('li').each(function () {
                $(this).removeClass('sq_patterns_selected');
            });

            //select the used ones
            if (words.length > 0) {
                for (var i = 0; i < words.length; i++) {
                    if (words[i].match(/{{[a-z_]+}}/g)) {
                        settings.sq_pattern_list.find('li').each(function () {
                            if (words[i] === $(this).html()) {
                                $(this).addClass('sq_patterns_selected');
                            }
                        });
                    }
                }
            }

            //Highlight the patterns
            if ($.fn.highlightWithinTextarea) {
                settings.field.highlightWithinTextarea({highlight: /({{[^\}]+}})/g});
            }

            if ($.fn.sq_checkMax) {
                settings.field.sq_checkMax();
            }
        };

        $this.highlightListen = function () {
            settings.field.highlightWithinTextarea({highlight: /({{[^\}]+}})/g});

            settings.field.off('change').on('change', function () {
                $(this).highlightWithinTextarea({highlight: /({{[^\}]+}})/g});
            });
        };

        if (settings.field) {
            $this.listenIcon();
            $this.highlightListen();

            //console.log(settings.field.attr('name'), settings.field.html());

        }


        return $this;

    };

    /**
     * Get the Snippet For a Post Type
     * @param post_id
     * @param post_type
     */
    $.fn.sq_getPatterns = function (post_id, term_id, taxonomy, post_type) {
        var $this = this;

        $this.addClass('sq_minloading');

        return $.post(
            sqQuery.ajaxurl,
            {
                action: 'sq_getpatterns',
                post_id: post_id,
                term_id: term_id,
                taxonomy: taxonomy,
                post_type: post_type,
                sq_nonce: sqQuery.nonce
            }
        ).done(function (response) {
            SQ_DEBUG && console.log(response);


            $this.removeClass('sq_minloading');
        }).fail(function () {
            SQ_DEBUG && console.log('no data received');

            $this.removeClass('sq_minloading');
        });
    };

    $(document).ready(function () {
        $('.sq_pattern_field').each(function () {
            $(this).sq_patterns().init();
        });
    });
})(jQuery);