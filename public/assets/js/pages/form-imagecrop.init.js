/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 26);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/form-imagecrop.init.js":
/*!***************************************************!*\
  !*** ./resources/js/pages/form-imagecrop.init.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/*\r\nTemplate Name: Ubold - Responsive Bootstrap 4 Admin Dashboard\r\nAuthor: CoderThemes\r\nWebsite: https://coderthemes.com/\r\nContact: support@coderthemes.com\r\nFile: Image crop init js\r\n*/\n$(function () {\n  'use strict';\n\n  var console = window.console || {\n    log: function log() {}\n  };\n  var URL = window.URL || window.webkitURL;\n  var $image = $('#image');\n  var $download = $('#download');\n  var $dataX = $('#dataX');\n  var $dataY = $('#dataY');\n  var $dataHeight = $('#dataHeight');\n  var $dataWidth = $('#dataWidth');\n  var $dataRotate = $('#dataRotate');\n  var $dataScaleX = $('#dataScaleX');\n  var $dataScaleY = $('#dataScaleY');\n  var options = {\n    aspectRatio: 16 / 9,\n    preview: '.img-preview',\n    crop: function crop(e) {\n      $dataX.val(Math.round(e.detail.x));\n      $dataY.val(Math.round(e.detail.y));\n      $dataHeight.val(Math.round(e.detail.height));\n      $dataWidth.val(Math.round(e.detail.width));\n      $dataRotate.val(e.detail.rotate);\n      $dataScaleX.val(e.detail.scaleX);\n      $dataScaleY.val(e.detail.scaleY);\n    }\n  };\n  var originalImageURL = $image.attr('src');\n  var uploadedImageName = 'cropped.jpg';\n  var uploadedImageType = 'image/jpeg';\n  var uploadedImageURL; // Tooltip\n\n  $('[data-toggle=\"tooltip\"]').tooltip(); // Cropper\n\n  $image.on({\n    ready: function ready(e) {\n      console.log(e.type);\n    },\n    cropstart: function cropstart(e) {\n      console.log(e.type, e.detail.action);\n    },\n    cropmove: function cropmove(e) {\n      console.log(e.type, e.detail.action);\n    },\n    cropend: function cropend(e) {\n      console.log(e.type, e.detail.action);\n    },\n    crop: function crop(e) {\n      console.log(e.type);\n    },\n    zoom: function zoom(e) {\n      console.log(e.type, e.detail.ratio);\n    }\n  }).cropper(options); // Buttons\n\n  if (!$.isFunction(document.createElement('canvas').getContext)) {\n    $('button[data-method=\"getCroppedCanvas\"]').prop('disabled', true);\n  }\n\n  if (typeof document.createElement('cropper').style.transition === 'undefined') {\n    $('button[data-method=\"rotate\"]').prop('disabled', true);\n    $('button[data-method=\"scale\"]').prop('disabled', true);\n  } // Download\n\n\n  if (typeof $download[0].download === 'undefined') {\n    $download.addClass('disabled');\n  } // Options\n\n\n  $('.docs-toggles').on('change', 'input', function () {\n    var $this = $(this);\n    var name = $this.attr('name');\n    var type = $this.prop('type');\n    var cropBoxData;\n    var canvasData;\n\n    if (!$image.data('cropper')) {\n      return;\n    }\n\n    if (type === 'checkbox') {\n      options[name] = $this.prop('checked');\n      cropBoxData = $image.cropper('getCropBoxData');\n      canvasData = $image.cropper('getCanvasData');\n\n      options.ready = function () {\n        $image.cropper('setCropBoxData', cropBoxData);\n        $image.cropper('setCanvasData', canvasData);\n      };\n    } else if (type === 'radio') {\n      options[name] = $this.val();\n    }\n\n    $image.cropper('destroy').cropper(options);\n  }); // Methods\n\n  $('.docs-buttons').on('click', '[data-method]', function () {\n    var $this = $(this);\n    var data = $this.data();\n    var cropper = $image.data('cropper');\n    var cropped;\n    var $target;\n    var result;\n\n    if ($this.prop('disabled') || $this.hasClass('disabled')) {\n      return;\n    }\n\n    if (cropper && data.method) {\n      data = $.extend({}, data); // Clone a new one\n\n      if (typeof data.target !== 'undefined') {\n        $target = $(data.target);\n\n        if (typeof data.option === 'undefined') {\n          try {\n            data.option = JSON.parse($target.val());\n          } catch (e) {\n            console.log(e.message);\n          }\n        }\n      }\n\n      cropped = cropper.cropped;\n\n      switch (data.method) {\n        case 'rotate':\n          if (cropped && options.viewMode > 0) {\n            $image.cropper('clear');\n          }\n\n          break;\n\n        case 'getCroppedCanvas':\n          if (uploadedImageType === 'image/jpeg') {\n            if (!data.option) {\n              data.option = {};\n            }\n\n            data.option.fillColor = '#fff';\n          }\n\n          break;\n      }\n\n      result = $image.cropper(data.method, data.option, data.secondOption);\n\n      switch (data.method) {\n        case 'rotate':\n          if (cropped && options.viewMode > 0) {\n            $image.cropper('crop');\n          }\n\n          break;\n\n        case 'scaleX':\n        case 'scaleY':\n          $(this).data('option', -data.option);\n          break;\n\n        case 'getCroppedCanvas':\n          if (result) {\n            // Bootstrap's Modal\n            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);\n\n            if (!$download.hasClass('disabled')) {\n              download.download = uploadedImageName;\n              $download.attr('href', result.toDataURL(uploadedImageType));\n            }\n          }\n\n          break;\n\n        case 'destroy':\n          if (uploadedImageURL) {\n            URL.revokeObjectURL(uploadedImageURL);\n            uploadedImageURL = '';\n            $image.attr('src', originalImageURL);\n          }\n\n          break;\n      }\n\n      if ($.isPlainObject(result) && $target) {\n        try {\n          $target.val(JSON.stringify(result));\n        } catch (e) {\n          console.log(e.message);\n        }\n      }\n    }\n  }); // Keyboard\n\n  $(document.body).on('keydown', function (e) {\n    if (e.target !== this || !$image.data('cropper') || this.scrollTop > 300) {\n      return;\n    }\n\n    switch (e.which) {\n      case 37:\n        e.preventDefault();\n        $image.cropper('move', -1, 0);\n        break;\n\n      case 38:\n        e.preventDefault();\n        $image.cropper('move', 0, -1);\n        break;\n\n      case 39:\n        e.preventDefault();\n        $image.cropper('move', 1, 0);\n        break;\n\n      case 40:\n        e.preventDefault();\n        $image.cropper('move', 0, 1);\n        break;\n    }\n  }); // Import image\n\n  var $inputImage = $('#inputImage');\n\n  if (URL) {\n    $inputImage.change(function () {\n      var files = this.files;\n      var file;\n\n      if (!$image.data('cropper')) {\n        return;\n      }\n\n      if (files && files.length) {\n        file = files[0];\n\n        if (/^image\\/\\w+$/.test(file.type)) {\n          uploadedImageName = file.name;\n          uploadedImageType = file.type;\n\n          if (uploadedImageURL) {\n            URL.revokeObjectURL(uploadedImageURL);\n          }\n\n          uploadedImageURL = URL.createObjectURL(file);\n          $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);\n          $inputImage.val('');\n        } else {\n          window.alert('Please choose an image file.');\n        }\n      }\n    });\n  } else {\n    $inputImage.prop('disabled', true).parent().addClass('disabled');\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFnZXMvZm9ybS1pbWFnZWNyb3AuaW5pdC5qcz8xMDdjIl0sIm5hbWVzIjpbIiQiLCJjb25zb2xlIiwid2luZG93IiwibG9nIiwiVVJMIiwid2Via2l0VVJMIiwiJGltYWdlIiwiJGRvd25sb2FkIiwiJGRhdGFYIiwiJGRhdGFZIiwiJGRhdGFIZWlnaHQiLCIkZGF0YVdpZHRoIiwiJGRhdGFSb3RhdGUiLCIkZGF0YVNjYWxlWCIsIiRkYXRhU2NhbGVZIiwib3B0aW9ucyIsImFzcGVjdFJhdGlvIiwicHJldmlldyIsImNyb3AiLCJlIiwidmFsIiwiTWF0aCIsInJvdW5kIiwiZGV0YWlsIiwieCIsInkiLCJoZWlnaHQiLCJ3aWR0aCIsInJvdGF0ZSIsInNjYWxlWCIsInNjYWxlWSIsIm9yaWdpbmFsSW1hZ2VVUkwiLCJhdHRyIiwidXBsb2FkZWRJbWFnZU5hbWUiLCJ1cGxvYWRlZEltYWdlVHlwZSIsInVwbG9hZGVkSW1hZ2VVUkwiLCJ0b29sdGlwIiwib24iLCJyZWFkeSIsInR5cGUiLCJjcm9wc3RhcnQiLCJhY3Rpb24iLCJjcm9wbW92ZSIsImNyb3BlbmQiLCJ6b29tIiwicmF0aW8iLCJjcm9wcGVyIiwiaXNGdW5jdGlvbiIsImRvY3VtZW50IiwiY3JlYXRlRWxlbWVudCIsImdldENvbnRleHQiLCJwcm9wIiwic3R5bGUiLCJ0cmFuc2l0aW9uIiwiZG93bmxvYWQiLCJhZGRDbGFzcyIsIiR0aGlzIiwibmFtZSIsImNyb3BCb3hEYXRhIiwiY2FudmFzRGF0YSIsImRhdGEiLCJjcm9wcGVkIiwiJHRhcmdldCIsInJlc3VsdCIsImhhc0NsYXNzIiwibWV0aG9kIiwiZXh0ZW5kIiwidGFyZ2V0Iiwib3B0aW9uIiwiSlNPTiIsInBhcnNlIiwibWVzc2FnZSIsInZpZXdNb2RlIiwiZmlsbENvbG9yIiwic2Vjb25kT3B0aW9uIiwibW9kYWwiLCJmaW5kIiwiaHRtbCIsInRvRGF0YVVSTCIsInJldm9rZU9iamVjdFVSTCIsImlzUGxhaW5PYmplY3QiLCJzdHJpbmdpZnkiLCJib2R5Iiwic2Nyb2xsVG9wIiwid2hpY2giLCJwcmV2ZW50RGVmYXVsdCIsIiRpbnB1dEltYWdlIiwiY2hhbmdlIiwiZmlsZXMiLCJmaWxlIiwibGVuZ3RoIiwidGVzdCIsImNyZWF0ZU9iamVjdFVSTCIsImFsZXJ0IiwicGFyZW50Il0sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7OztBQVFBQSxDQUFDLENBQUMsWUFBWTtBQUNWOztBQUVBLE1BQUlDLE9BQU8sR0FBR0MsTUFBTSxDQUFDRCxPQUFQLElBQWtCO0FBQUVFLE9BQUcsRUFBRSxlQUFZLENBQUc7QUFBdEIsR0FBaEM7QUFDQSxNQUFJQyxHQUFHLEdBQUdGLE1BQU0sQ0FBQ0UsR0FBUCxJQUFjRixNQUFNLENBQUNHLFNBQS9CO0FBQ0EsTUFBSUMsTUFBTSxHQUFHTixDQUFDLENBQUMsUUFBRCxDQUFkO0FBQ0EsTUFBSU8sU0FBUyxHQUFHUCxDQUFDLENBQUMsV0FBRCxDQUFqQjtBQUNBLE1BQUlRLE1BQU0sR0FBR1IsQ0FBQyxDQUFDLFFBQUQsQ0FBZDtBQUNBLE1BQUlTLE1BQU0sR0FBR1QsQ0FBQyxDQUFDLFFBQUQsQ0FBZDtBQUNBLE1BQUlVLFdBQVcsR0FBR1YsQ0FBQyxDQUFDLGFBQUQsQ0FBbkI7QUFDQSxNQUFJVyxVQUFVLEdBQUdYLENBQUMsQ0FBQyxZQUFELENBQWxCO0FBQ0EsTUFBSVksV0FBVyxHQUFHWixDQUFDLENBQUMsYUFBRCxDQUFuQjtBQUNBLE1BQUlhLFdBQVcsR0FBR2IsQ0FBQyxDQUFDLGFBQUQsQ0FBbkI7QUFDQSxNQUFJYyxXQUFXLEdBQUdkLENBQUMsQ0FBQyxhQUFELENBQW5CO0FBQ0EsTUFBSWUsT0FBTyxHQUFHO0FBQ1ZDLGVBQVcsRUFBRSxLQUFLLENBRFI7QUFFVkMsV0FBTyxFQUFFLGNBRkM7QUFHVkMsUUFBSSxFQUFFLGNBQVVDLENBQVYsRUFBYTtBQUNmWCxZQUFNLENBQUNZLEdBQVAsQ0FBV0MsSUFBSSxDQUFDQyxLQUFMLENBQVdILENBQUMsQ0FB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bEQsSUFBekI7O0FBRUEsY0FBSUosZ0JBQUosRUFBc0I7QUFDbEIvQixlQUFHLENBQUMyRSxlQUFKLENBQW9CNUMsZ0JBQXBCO0FBQ0g7O0FBRURBLDBCQUFnQixHQUFHL0IsR0FBRyxDQUFDd0YsZUFBSixDQUFvQkgsSUFBcEIsQ0FBbkI7QUFDQW5GLGdCQUFNLENBQUN3QyxPQUFQLENBQWUsU0FBZixFQUEwQmQsSUFBMUIsQ0FBK0IsS0FBL0IsRUFBc0NHLGdCQUF0QyxFQUF3RFcsT0FBeEQsQ0FBZ0UvQixPQUFoRTtBQUNBdUUscUJBQVcsQ0FBQ2xFLEdBQVosQ0FBZ0IsRUFBaEI7QUFDSCxTQVhELE1BV087QUFDSGxCLGdCQUFNLENBQUMyRixLQUFQLENBQWEsOEJBQWI7QUFDSDtBQUNKO0FBQ0osS0ExQkQ7QUEyQkgsR0E1QkQsTUE0Qk87QUFDSFAsZUFBVyxDQUFDbkMsSUFBWixDQUFpQixVQUFqQixFQUE2QixJQUE3QixFQUFtQzJDLE1BQW5DLEdBQTRDdkMsUUFBNUMsQ0FBcUQsVUFBckQ7QUFDSDtBQUNKLENBclFBLENBQUQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGFnZXMvZm9ybS1pbWFnZWNyb3AuaW5pdC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qXHJcblRlbXBsYXRlIE5hbWU6IFVib2xkIC0gUmVzcG9uc2l2ZSBCb290c3RyYXAgNCBBZG1pbiBEYXNoYm9hcmRcclxuQXV0aG9yOiBDb2RlclRoZW1lc1xyXG5XZWJzaXRlOiBodHRwczovL2NvZGVydGhlbWVzLmNvbS9cclxuQ29udGFjdDogc3VwcG9ydEBjb2RlcnRoZW1lcy5jb21cclxuRmlsZTogSW1hZ2UgY3JvcCBpbml0IGpzXHJcbiovXHJcblxyXG4kKGZ1bmN0aW9uICgpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICB2YXIgY29uc29sZSA9IHdpbmRvdy5jb25zb2xlIHx8IHsgbG9nOiBmdW5jdGlvbiAoKSB7IH0gfTtcclxuICAgIHZhciBVUkwgPSB3aW5kb3cuVVJMIHx8IHdpbmRvdy53ZWJraXRVUkw7XHJcbiAgICB2YXIgJGltYWdlID0gJCgnI2ltYWdlJyk7XHJcbiAgICB2YXIgJGRvd25sb2FkID0gJCgnI2Rvd25sb2FkJyk7XHJcbiAgICB2YXIgJGRhdGFYID0gJCgnI2RhdGFYJyk7XHJcbiAgICB2YXIgJGRhdGFZID0gJCgnI2RhdGFZJyk7XHJcbiAgICB2YXIgJGRhdGFIZWlnaHQgPSAkKCcjZGF0YUhlaWdodCcpO1xyXG4gICAgdmFyICRkYXRhV2lkdGggPSAkKCcjZGF0YVdpZHRoJyk7XHJcbiAgICB2YXIgJGRhdGFSb3RhdGUgPSAkKCcjZGF0YVJvdGF0ZScpO1xyXG4gICAgdmFyICRkYXRhU2NhbGVYID0gJCgnI2RhdGFTY2FsZVgnKTtcclxuICAgIHZhciAkZGF0YVNjYWxlWSA9ICQoJyNkYXRhU2NhbGVZJyk7XHJcbiAgICB2YXIgb3B0aW9ucyA9IHtcclxuICAgICAgICBhc3BlY3RSYXRpbzogMTYgLyA5LFxyXG4gICAgICAgIHByZXZpZXc6ICcuaW1nLXByZXZpZXcnLFxyXG4gICAgICAgIGNyb3A6IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgICRkYXRhWC52YWwoTWF0aC5yb3VuZChlLmRldGFpbC54KSk7XHJcbiAgICAgICAgICAgICRkYXRhWS52YWwoTWF0aC5yb3VuZChlLmRldGFpbC55KSk7XHJcbiAgICAgICAgICAgICRkYXRhSGVpZ2h0LnZhbChNYXRoLnJvdW5kKGUuZGV0YWlsLmhlaWdodCkpO1xyXG4gICAgICAgICAgICAkZGF0YVdpZHRoLnZhbChNYXRoLnJvdW5kKGUuZGV0YWlsLndpZHRoKSk7XHJcbiAgICAgICAgICAgICRkYXRhUm90YXRlLnZhbChlLmRldGFpbC5yb3RhdGUpO1xyXG4gICAgICAgICAgICAkZGF0YVNjYWxlWC52YWwoZS5kZXRhaWwuc2NhbGVYKTtcclxuICAgICAgICAgICAgJGRhdGFTY2FsZVkudmFsKGUuZGV0YWlsLnNjYWxlWSk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxuICAgIHZhciBvcmlnaW5hbEltYWdlVVJMID0gJGltYWdlLmF0dHIoJ3NyYycpO1xyXG4gICAgdmFyIHVwbG9hZGVkSW1hZ2VOYW1lID0gJ2Nyb3BwZWQuanBnJztcclxuICAgIHZhciB1cGxvYWRlZEltYWdlVHlwZSA9ICdpbWFnZS9qcGVnJztcclxuICAgIHZhciB1cGxvYWRlZEltYWdlVVJMO1xyXG5cclxuICAgIC8vIFRvb2x0aXBcclxuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInRvb2x0aXBcIl0nKS50b29sdGlwKCk7XHJcblxyXG4gICAgLy8gQ3JvcHBlclxyXG4gICAgJGltYWdlLm9uKHtcclxuICAgICAgICByZWFkeTogZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgY29uc29sZS5sb2coZS50eXBlKTtcclxuICAgICAgICB9LFxyXG4gICAgICAgIGNyb3BzdGFydDogZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgY29uc29sZS5sb2coZS50eXBlLCBlLmRldGFpbC5hY3Rpb24pO1xyXG4gICAgICAgIH0sXHJcbiAgICAgICAgY3JvcG1vdmU6IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKGUudHlwZSwgZS5kZXRhaWwuYWN0aW9uKTtcclxuICAgICAgICB9LFxyXG4gICAgICAgIGNyb3BlbmQ6IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKGUudHlwZSwgZS5kZXRhaWwuYWN0aW9uKTtcclxuICAgICAgICB9LFxyXG4gICAgICAgIGNyb3A6IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKGUudHlwZSk7XHJcbiAgICAgICAgfSxcclxuICAgICAgICB6b29tOiBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgICBjb25zb2xlLmxvZyhlLnR5cGUsIGUuZGV0YWlsLnJhdGlvKTtcclxuICAgICAgICB9XHJcbiAgICB9KS5jcm9wcGVyKG9wdGlvbnMpO1xyXG5cclxuICAgIC8vIEJ1dHRvbnNcclxuICAgIGlmICghJC5pc0Z1bmN0aW9uKGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2NhbnZhcycpLmdldENvbnRleHQpKSB7XHJcbiAgICAgICAgJCgnYnV0dG9uW2RhdGEtbWV0aG9kPVwiZ2V0Q3JvcHBlZENhbnZhc1wiXScpLnByb3AoJ2Rpc2FibGVkJywgdHJ1ZSk7XHJcbiAgICB9XHJcblxyXG4gICAgaWYgKHR5cGVvZiBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdjcm9wcGVyJykuc3R5bGUudHJhbnNpdGlvbiA9PT0gJ3VuZGVmaW5lZCcpIHtcclxuICAgICAgICAkKCdidXR0b25bZGF0YS1tZXRob2Q9XCJyb3RhdGVcIl0nKS5wcm9wKCdkaXNhYmxlZCcsIHRydWUpO1xyXG4gICAgICAgICQoJ2J1dHRvbltkYXRhLW1ldGhvZD1cInNjYWxlXCJdJykucHJvcCgnZGlzYWJsZWQnLCB0cnVlKTtcclxuICAgIH1cclxuXHJcbiAgICAvLyBEb3dubG9hZFxyXG4gICAgaWYgKHR5cGVvZiAkZG93bmxvYWRbMF0uZG93bmxvYWQgPT09ICd1bmRlZmluZWQnKSB7XHJcbiAgICAgICAgJGRvd25sb2FkLmFkZENsYXNzKCdkaXNhYmxlZCcpO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIE9wdGlvbnNcclxuICAgICQoJy5kb2NzLXRvZ2dsZXMnKS5vbignY2hhbmdlJywgJ2lucHV0JywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIHZhciAkdGhpcyA9ICQodGhpcyk7XHJcbiAgICAgICAgdmFyIG5hbWUgPSAkdGhpcy5hdHRyKCduYW1lJyk7XHJcbiAgICAgICAgdmFyIHR5cGUgPSAkdGhpcy5wcm9wKCd0eXBlJyk7XHJcbiAgICAgICAgdmFyIGNyb3BCb3hEYXRhO1xyXG4gICAgICAgIHZhciBjYW52YXNEYXRhO1xyXG5cclxuICAgICAgICBpZiAoISRpbWFnZS5kYXRhKCdjcm9wcGVyJykpIHtcclxuICAgICAgICAgICAgcmV0dXJuO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgaWYgKHR5cGUgPT09ICdjaGVja2JveCcpIHtcclxuICAgICAgICAgICAgb3B0aW9uc1tuYW1lXSA9ICR0aGlzLnByb3AoJ2NoZWNrZWQnKTtcclxuICAgICAgICAgICAgY3JvcEJveERhdGEgPSAkaW1hZ2UuY3JvcHBlcignZ2V0Q3JvcEJveERhdGEnKTtcclxuICAgICAgICAgICAgY2FudmFzRGF0YSA9ICRpbWFnZS5jcm9wcGVyKCdnZXRDYW52YXNEYXRhJyk7XHJcblxyXG4gICAgICAgICAgICBvcHRpb25zLnJlYWR5ID0gZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAgICAgJGltYWdlLmNyb3BwZXIoJ3NldENyb3BCb3hEYXRhJywgY3JvcEJveERhdGEpO1xyXG4gICAgICAgICAgICAgICAgJGltYWdlLmNyb3BwZXIoJ3NldENhbnZhc0RhdGEnLCBjYW52YXNEYXRhKTtcclxuICAgICAgICAgICAgfTtcclxuICAgICAgICB9IGVsc2UgaWYgKHR5cGUgPT09ICdyYWRpbycpIHtcclxuICAgICAgICAgICAgb3B0aW9uc1tuYW1lXSA9ICR0aGlzLnZhbCgpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJGltYWdlLmNyb3BwZXIoJ2Rlc3Ryb3knKS5jcm9wcGVyKG9wdGlvbnMpO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gTWV0aG9kc1xyXG4gICAgJCgnLmRvY3MtYnV0dG9ucycpLm9uKCdjbGljaycsICdbZGF0YS1tZXRob2RdJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIHZhciAkdGhpcyA9ICQodGhpcyk7XHJcbiAgICAgICAgdmFyIGRhdGEgPSAkdGhpcy5kYXRhKCk7XHJcbiAgICAgICAgdmFyIGNyb3BwZXIgPSAkaW1hZ2UuZGF0YSgnY3JvcHBlcicpO1xyXG4gICAgICAgIHZhciBjcm9wcGVkO1xyXG4gICAgICAgIHZhciAkdGFyZ2V0O1xyXG4gICAgICAgIHZhciByZXN1bHQ7XHJcblxyXG4gICAgICAgIGlmICgkdGhpcy5wcm9wKCdkaXNhYmxlZCcpIHx8ICR0aGlzLmhhc0NsYXNzKCdkaXNhYmxlZCcpKSB7XHJcbiAgICAgICAgICAgIHJldHVybjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGlmIChjcm9wcGVyICYmIGRhdGEubWV0aG9kKSB7XHJcbiAgICAgICAgICAgIGRhdGEgPSAkLmV4dGVuZCh7fSwgZGF0YSk7IC8vIENsb25lIGEgbmV3IG9uZVxyXG5cclxuICAgICAgICAgICAgaWYgKHR5cGVvZiBkYXRhLnRhcmdldCAhPT0gJ3VuZGVmaW5lZCcpIHtcclxuICAgICAgICAgICAgICAgICR0YXJnZXQgPSAkKGRhdGEudGFyZ2V0KTtcclxuXHJcbiAgICAgICAgICAgICAgICBpZiAodHlwZW9mIGRhdGEub3B0aW9uID09PSAndW5kZWZpbmVkJykge1xyXG4gICAgICAgICAgICAgICAgICAgIHRyeSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRhdGEub3B0aW9uID0gSlNPTi5wYXJzZSgkdGFyZ2V0LnZhbCgpKTtcclxuICAgICAgICAgICAgICAgICAgICB9IGNhdGNoIChlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGUubWVzc2FnZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBjcm9wcGVkID0gY3JvcHBlci5jcm9wcGVkO1xyXG5cclxuICAgICAgICAgICAgc3dpdGNoIChkYXRhLm1ldGhvZCkge1xyXG4gICAgICAgICAgICAgICAgY2FzZSAncm90YXRlJzpcclxuICAgICAgICAgICAgICAgICAgICBpZiAoY3JvcHBlZCAmJiBvcHRpb25zLnZpZXdNb2RlID4gMCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkaW1hZ2UuY3JvcHBlcignY2xlYXInKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGJyZWFrO1xyXG5cclxuICAgICAgICAgICAgICAgIGNhc2UgJ2dldENyb3BwZWRDYW52YXMnOlxyXG4gICAgICAgICAgICAgICAgICAgIGlmICh1cGxvYWRlZEltYWdlVHlwZSA9PT0gJ2ltYWdlL2pwZWcnKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmICghZGF0YS5vcHRpb24pIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGRhdGEub3B0aW9uID0ge307XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRhdGEub3B0aW9uLmZpbGxDb2xvciA9ICcjZmZmJztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGJyZWFrO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICByZXN1bHQgPSAkaW1hZ2UuY3JvcHBlcihkYXRhLm1ldGhvZCwgZGF0YS5vcHRpb24sIGRhdGEuc2Vjb25kT3B0aW9uKTtcclxuXHJcbiAgICAgICAgICAgIHN3aXRjaCAoZGF0YS5tZXRob2QpIHtcclxuICAgICAgICAgICAgICAgIGNhc2UgJ3JvdGF0ZSc6XHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKGNyb3BwZWQgJiYgb3B0aW9ucy52aWV3TW9kZSA+IDApIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJGltYWdlLmNyb3BwZXIoJ2Nyb3AnKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGJyZWFrO1xyXG5cclxuICAgICAgICAgICAgICAgIGNhc2UgJ3NjYWxlWCc6XHJcbiAgICAgICAgICAgICAgICBjYXNlICdzY2FsZVknOlxyXG4gICAgICAgICAgICAgICAgICAgICQodGhpcykuZGF0YSgnb3B0aW9uJywgLWRhdGEub3B0aW9uKTtcclxuICAgICAgICAgICAgICAgICAgICBicmVhaztcclxuXHJcbiAgICAgICAgICAgICAgICBjYXNlICdnZXRDcm9wcGVkQ2FudmFzJzpcclxuICAgICAgICAgICAgICAgICAgICBpZiAocmVzdWx0KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC8vIEJvb3RzdHJhcCdzIE1vZGFsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICQoJyNnZXRDcm9wcGVkQ2FudmFzTW9kYWwnKS5tb2RhbCgpLmZpbmQoJy5tb2RhbC1ib2R5JykuaHRtbChyZXN1bHQpO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgaWYgKCEkZG93bmxvYWQuaGFzQ2xhc3MoJ2Rpc2FibGVkJykpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGRvd25sb2FkLmRvd25sb2FkID0gdXBsb2FkZWRJbWFnZU5hbWU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkZG93bmxvYWQuYXR0cignaHJlZicsIHJlc3VsdC50b0RhdGFVUkwodXBsb2FkZWRJbWFnZVR5cGUpKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgYnJlYWs7XHJcblxyXG4gICAgICAgICAgICAgICAgY2FzZSAnZGVzdHJveSc6XHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKHVwbG9hZGVkSW1hZ2VVUkwpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgVVJMLnJldm9rZU9iamVjdFVSTCh1cGxvYWRlZEltYWdlVVJMKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdXBsb2FkZWRJbWFnZVVSTCA9ICcnO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkaW1hZ2UuYXR0cignc3JjJywgb3JpZ2luYWxJbWFnZVVSTCk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICBicmVhaztcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgaWYgKCQuaXNQbGFpbk9iamVjdChyZXN1bHQpICYmICR0YXJnZXQpIHtcclxuICAgICAgICAgICAgICAgIHRyeSB7XHJcbiAgICAgICAgICAgICAgICAgICAgJHRhcmdldC52YWwoSlNPTi5zdHJpbmdpZnkocmVzdWx0KSk7XHJcbiAgICAgICAgICAgICAgICB9IGNhdGNoIChlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coZS5tZXNzYWdlKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuICAgIC8vIEtleWJvYXJkXHJcbiAgICAkKGRvY3VtZW50LmJvZHkpLm9uKCdrZXlkb3duJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICBpZiAoZS50YXJnZXQgIT09IHRoaXMgfHwgISRpbWFnZS5kYXRhKCdjcm9wcGVyJykgfHwgdGhpcy5zY3JvbGxUb3AgPiAzMDApIHtcclxuICAgICAgICAgICAgcmV0dXJuO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgc3dpdGNoIChlLndoaWNoKSB7XHJcbiAgICAgICAgICAgIGNhc2UgMzc6XHJcbiAgICAgICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgICAgICAkaW1hZ2UuY3JvcHBlcignbW92ZScsIC0xLCAwKTtcclxuICAgICAgICAgICAgICAgIGJyZWFrO1xyXG5cclxuICAgICAgICAgICAgY2FzZSAzODpcclxuICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgICAgICRpbWFnZS5jcm9wcGVyKCdtb3ZlJywgMCwgLTEpO1xyXG4gICAgICAgICAgICAgICAgYnJlYWs7XHJcblxyXG4gICAgICAgICAgICBjYXNlIDM5OlxyXG4gICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICAgICAgJGltYWdlLmNyb3BwZXIoJ21vdmUnLCAxLCAwKTtcclxuICAgICAgICAgICAgICAgIGJyZWFrO1xyXG5cclxuICAgICAgICAgICAgY2FzZSA0MDpcclxuICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgICAgICRpbWFnZS5jcm9wcGVyKCdtb3ZlJywgMCwgMSk7XHJcbiAgICAgICAgICAgICAgICBicmVhaztcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbiAgICAvLyBJbXBvcnQgaW1hZ2VcclxuICAgIHZhciAkaW5wdXRJbWFnZSA9ICQoJyNpbnB1dEltYWdlJyk7XHJcblxyXG4gICAgaWYgKFVSTCkge1xyXG4gICAgICAgICRpbnB1dEltYWdlLmNoYW5nZShmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIHZhciBmaWxlcyA9IHRoaXMuZmlsZXM7XHJcbiAgICAgICAgICAgIHZhciBmaWxlO1xyXG5cclxuICAgICAgICAgICAgaWYgKCEkaW1hZ2UuZGF0YSgnY3JvcHBlcicpKSB7XHJcbiAgICAgICAgICAgICAgICByZXR1cm47XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIGlmIChmaWxlcyAmJiBmaWxlcy5sZW5ndGgpIHtcclxuICAgICAgICAgICAgICAgIGZpbGUgPSBmaWxlc1swXTtcclxuXHJcbiAgICAgICAgICAgICAgICBpZiAoL15pbWFnZVxcL1xcdyskLy50ZXN0KGZpbGUudHlwZSkpIHtcclxuICAgICAgICAgICAgICAgICAgICB1cGxvYWRlZEltYWdlTmFtZSA9IGZpbGUubmFtZTtcclxuICAgICAgICAgICAgICAgICAgICB1cGxvYWRlZEltYWdlVHlwZSA9IGZpbGUudHlwZTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKHVwbG9hZGVkSW1hZ2VVUkwpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgVVJMLnJldm9rZU9iamVjdFVSTCh1cGxvYWRlZEltYWdlVVJMKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIHVwbG9hZGVkSW1hZ2VVUkwgPSBVUkwuY3JlYXRlT2JqZWN0VVJMKGZpbGUpO1xyXG4gICAgICAgICAgICAgICAgICAgICRpbWFnZS5jcm9wcGVyKCdkZXN0cm95JykuYXR0cignc3JjJywgdXBsb2FkZWRJbWFnZVVSTCkuY3JvcHBlcihvcHRpb25zKTtcclxuICAgICAgICAgICAgICAgICAgICAkaW5wdXRJbWFnZS52YWwoJycpO1xyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICB3aW5kb3cuYWxlcnQoJ1BsZWFzZSBjaG9vc2UgYW4gaW1hZ2UgZmlsZS4nKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSBlbHNlIHtcclxuICAgICAgICAkaW5wdXRJbWFnZS5wcm9wKCdkaXNhYmxlZCcsIHRydWUpLnBhcmVudCgpLmFkZENsYXNzKCdkaXNhYmxlZCcpO1xyXG4gICAgfVxyXG59KTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/pages/form-imagecrop.init.js\n");

/***/ }),

/***/ 26:
/*!*********************************************************!*\
  !*** multi ./resources/js/pages/form-imagecrop.init.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Mohammed\Desktop\ai-attend\resources\js\pages\form-imagecrop.init.js */"./resources/js/pages/form-imagecrop.init.js");


/***/ })

/******/ });