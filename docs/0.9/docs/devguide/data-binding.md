---
layout: default
type: guide
shortname: Docs
title: Data binding
subtitle: Developer guide
---

{% include toc.html %}

Data binding binds a property or sub-property of a custom element (the _host element_) to 
a property or attribute of an element in its local DOM (the _child_ or _target element_).

A binding is created with a binding _annotation_ in the host element's local DOM template:

    <dom-module id="host-element">
        <template>
          <child-element name="{%raw%}{{myName}}{%endraw%}"></child-element>  
        </template>
    </dom-module>


## Binding annotations {#property-binding}

A binding annotation consists of a property name or subproperty name enclosed
in curly brackets (`{%raw%}{{}}{%endraw%}`) or square brackets (`[[]]`).

*  Square brackets (`[[]]`) create _one-way bindings_. Data flow is 
   downward, host-to-child, and the binding **never** modifies the host property.

*  Curly brackets ({%raw%}`{{}}`{%endraw%}) create _automatic bindings_. Data flow is 
   one-way or two-way, depending whether the target property is configured
   for two-way binding.

To bind to a child property, specify the attribute name that corresponds to the
property, with an annotation as the attribute value:

    <child-element name="{%raw%}{{myName}}{%endraw%}"></child-element>  

This example binds the child element's `name` property to the host element's
`myName` property.

While HTML attributes are used to specify bindings, values are
assigned directly to JavaScript properties, **not** to the HTML attributes of the
elements. (There is a [special attribute binding syntax](#attribute-binding) for
those cases where you want to bind to an attribute value.)

Attribute names are mapped to property names as described in [Property name to
attribute name mapping](properties.html#property-name-mapping). To
bind to camel-case properties of elements, use dash-case in the attribute name.
For example:

    {%raw%}<user-view first-name="{{managerName}}"></user-view>{%endraw%}
    <!-- Sets <user-view>.firstName = this.managerName; -->

**Some attributes are special.** When binding to `style`, `href`, `class`, `for` or
`data-*` attributes, it is recommend that you use [attribute binding](#attribute-binding) 
syntax. For more information, see [Binding to native element attributes](#native-binding). 
{: .alert .alert-info }

### Binding to text content 

To bind to a child element's `textContent`, you can simply include the
annotation inside the child element. The binding annotation must currently span
the **entire content** of the tag:

    {% raw %}
    <dom-module id="user-view">
        <template>   
          First: <span>{{first}}</span><br>
          Last: <span>{{last}}</span>
        </template>
    </dom-module>
    {% endraw %}
    <script>
      Polymer({
        is: 'user-view',
        properties: {
          first: String,
          last: String
        }
      });
    </script>

    <user-view first="Samuel" last="Adams"></user-view>

String concatenation is **not** supported inside a tag, and the tag **can't 
contain any whitespace**:

    {% raw %}
    <!-- Not currently supported! -->
    <div>First: {{first}}</div>
    <div>Last: {{last}}</div>

    <!-- Not currently supported! -->
    <div>
      {{title}}
    </div>
    {% endraw %}

Binding to text content is always one-way, host-to-child.

### Binding to sub-properties

Binding annotations can also include paths to sub-properties, as shown below:

    <dom-module id="main-view">
      <template>
        {%raw%}<user-view first="{{user.first}}" last="{{user.last}}"></user-view>{%endraw%}
      </template>
    </dom-module>

    <script>
      Polymer({
        is: 'main-view',
        properties: {
          user: Object
        }
      });
    </script>

See [Binding to structured data](#path-binding) for details.

### Property change notification and two-way binding {#property-notification}

Polymer supports cooperative two-way binding between elements, allowing elements
that "produce" data or propagate data changes upwards to
hosts when desired.

To avoid two-way binding, use "square-brace" syntax (`[[property]]`), which 
results in only one-way (downward, host-to-child) data-binding.

To summarize, two-way data-binding is achieved when both the host and the child
agree to participate, satisfying these three conditions:

1. The host must use curly-brace `{%raw%}{{property}}{%endraw%}` syntax. (Square-brace
`[[property]]` syntax results in one-way downward binding, regardless of how the 
child property is configured.)

2. The child property being bound to must be configured with the `notify` flag
set to `true` (or otherwise send a `<property>-changed` custom event).  (If the
property being bound does not have the `notify` flag set, only one-way
(downward) binding will occur.)

3. The child property being bound to must **not** be configured with the `readOnly`
flag set to true.  (If the child property is `notify: true` and `readOnly:true`,
and the host binding uses curly-brace syntax, the binding is
one-way, **upward** (child-to-host).)

Example 1: Two-way binding

    <script>
      Polymer({
        is: 'custom-element',
        properties: {
          prop: {
            type: String,
            notify: true
          }
        }
      });
    </script>
    ...

    <!-- changes to "value" propagate downward to "prop" on child -->
    <!-- changes to "prop" propagate upward to "value" on host  -->
    <custom-element prop="{%raw%}{{value}}{%endraw%}"></custom-element>

Example 2: One-way binding (downward)

    <script>
      Polymer({
        is: 'custom-element',
        properties: {
          prop: {
            type: String,
            notify: true
          }
        }
      });
    </script>

    ...

    <!-- changes to "value" propagate downward to "prop" on child -->
    <!-- changes to "prop" are ignored by host due to square-bracket syntax -->
    <custom-element prop="[[value]]"></custom-element>

Example 3: One-way binding (downward)

    <script>

      Polymer({
        is: 'custom-element',
        properties: {
          prop: String    // no notify:true!
        }
      });

    </script>
    ...

    <!-- changes to "value" propagate downward to "prop" on child -->
    <!-- changes to "prop" are not notified to host due to notify:falsey -->
    <custom-element prop="{%raw%}{{value}}{%endraw%}"></custom-element>

Example 4: One-way binding (upward, child-to-host)

    <script>
      Polymer({
        is: 'custom-element',
        properties: {
          prop: {
              type: String,
              notify: true,
              readOnly: true
            }
        }
      });
    </script>

    ...

    <!-- changes to "value" are ignored by child due to readOnly:true -->
    <!-- changes to "prop" propagate upward to "value" on host  -->
    <custom-element prop="{%raw%}{{value}}{%endraw%}"></custom-element>

Example 5: Error / non-sensical state

    <script>
      Polymer({
        is: 'custom-element',
        properties: {
          prop: {
              type: String,
              notify: true,
              readOnly: true
            }
        }
      });
    </script>
    ...
    <!-- changes to "value" are ignored by child due to readOnly:true -->
    <!-- changes to "prop" are ignored by host due to square-bracket syntax -->
    <!-- binding serves no purpose -->
    <custom-element prop="[[value]]"></custom-element>

### Change notification protocol

When you configure a declared property with the `notify` flag set to `true`,
{{site.project_title}} propagates data changes upward by firing events:

*   When the property changes, the element fires a non-bubbling DOM
    event to indicate those changes to interested hosts. 

*   The event follows a naming convention of <code><var>property</var>-changed</code>, 
    and contains a `value` property in the `event.detail` object indicating 
    the property's new value.

When using a {{site.project_title}} element with other elements or frameworks, you can 
manually attach an <code>on-<var>property</var>-changed</code> listener to an element to
be notified of property changes, and take the necessary actions based on the new value. 

This is essentially what {{site.project_title}} does when you create a two-way data
binding.


### Two-way binding to native elements {#two-way-native}

As mentioned above, {{site.project.title}} uses an event naming convention to achieve two-way
binding. 

To two-way bind to native elements or non-Polymer elements that _don't_
follow this event naming convention, you can specify a
custom change event name in the annotation using the following syntax:

<code><var>target-prop</var>="{%raw%}{{<var>hostProp</var>::<var>target-change-event</var>}}{%endraw%}"</code>


Example:

    {% raw %}
    <!-- Listens for `input` event and sets hostValue to <input>.value -->
    <input value="{{hostValue::input}}">

    <!-- Listens for `change` event and sets hostChecked to <input>.checked -->
    <input type="checkbox" checked="{{hostChecked::change}}">

    <!-- Listens for `timeupdate ` event and sets hostTime to <video>.currentTime -->
    <video url="..." current-time="{{hostTime::timeupdate}}">
    {% endraw %}

Note: When binding to standard notifying properties on {{site.project_title}} elements,
specifying the event name is unnecessary, as the default convention will be
used.  The following constructions are equivalent:

    {% raw %}
    <!-- Listens for `value-changed` event -->
    <my-element value="{{hostValue::value-changed}}">

    <!-- Listens for `value-changed` event using Polymer convention by default -->
    <my-element value="{{hostValue}}">
    {% endraw %}


## Binding to structured data {#path-binding}

You can bind sub-properties of the host by specifying a _path_ inside 
the binding annotation.

Example:

    <template>
      <div>{%raw%}{{user.manager.name}}{%endraw%}</div>
      <user-element user="{%raw%}{{user}}{%endraw%}"></user-element>
    </template>

The path syntax doesn't support array-style accessors (such as `users[0].name`). 
However, you can include indexes directly in the path (`users.0.name`).

For a path binding to update, the path value must be updated in one of the 
following ways: 

*   Using a {{site.project_title}} 
    [property binding](#property-binding) to another element.

*   Using the [`set`](#set-path) API, which
    provides the required notification to elements with registered interest.

**Note:** These requirements are identical to the requirements for 
[sub-property change observers](properties.html#observing-path-changes), which use
the same notification system.
{: .alert .alert-info }

Path bindings are distinct from property bindings in a subtle way:

*   When a **property** value changes, the host element assigns the 
    new value to the bound property property on the child element.

*   When two elements are bound to the same path of a shared object and 
    the value at that path changes, the new value is immediately visible
    to both elements, because both elements are accessing the same object.

    In this case, the element that _changed_ the path must notify the system 
    so that other elements that have registered interest in the same path 
    may take side effects. Path bindings notify the system automatically.
    Imperative code must call `set`.

**Path bindings are two-way.** There is no concept of one-way bindings for 
paths, since the data does not propagate. That is, all bindings and 
change handlers for the same path will always be notified and update when the 
value of the path changes.
{: .alert .alert-info }

### Path change notification {#set-path}

Two-way data-binding and observation of paths in Polymer is achieved using a
similar strategy to the one described above for [2-way property binding
](#property-notification): 

1.  When a sub-property of a property configured with
    `type: Object` changes, an element fires a non-bubbling `<property>-changed` DOM
    event with a `detail.path` value indicating the path on the object that changed.

2.  Elements that have registered interest in that object (either via binding or
    change handler) may then take the appropriate action.  

3.  Finally, those elements will forward the notification on to any
    children they have bound the object to, and will also fire a new
    `<property>-changed` event where `property` is the root object, to notify any
    hosts that may have bound root object down.  

This way, a notification reaches any part of the tree that has
registered interest in that path so that side effects occur.

This system "just works" to the extent that changes to object sub-properties
occur as a result of being bound to a notifying custom element property that
changed.  However, sometimes imperative code needs to change an object's sub-
properties directly.  As we avoid more sophisticated observation mechanisms such
as `Object.observe` or dirty-checking in order to achieve the best startup and
runtime performance cross-platform for the most common use cases, changing an
object's sub-properties directly requires cooperation from the user.

Specifically, Polymer provides two API's that allow such changes to be notified
to the system: `notifyPath(path, value)` and `set(path, value)`, where `path` is 
a **string** identifying the path (relative to the host element). 

Example:

    <dom-module id="custom-element">
      <template>
        <div>{%raw%}{{user.manager.name}}{%endraw%}</div>
      </template>
    </dom-module>

    <script>
      Polymer({
        is: 'custom-element',
        reassignManager: function(newManager) {
          this.user.manager = newManager;
          // Notification required for binding to update!
          this.notifyPath('user.manager', this.user.manager);
        }
      });
    </script>

Most of the time, `notifyPath` is called directly after an
assignment, so a convenience function `set` is provided that performs both
actions:

    reassignManager: function(newManager) {
      this.set('user.manager', newManager);
    }


**Note:** Paths do not support array access notation (such as `users[2]`),
but do support array indexes in dotted paths (that is, `users.2`).
{: .alert .alert-info }

## Expressions in binding annotations

Currently there's no general support for expressions in binding annotations.
The two exceptions are:

*   Negation using `!`:

    Example:

        <template>
          <div hidden="{%raw%}{{!enabled}}{%endraw%}"></div>
        </template>

*   Computed bindings, as described in 
    [Computed bindings](#annotated-computed), below.

## Computed bindings {#annotated-computed}

For more complicated bindings, you can use a computed binding.
A computed binding is similar to a computed property. 

The computed binding **must take at least one dependent property.** A computed binding's 
dependent properties are interpreted relative to the current _binding scope_, which 
is useful inside a [template repeater](#dom-repeat).

A computed binding is useful if you don't need to expose a computed property
as part of the element's API, or use it elsewhere in the element.

**Note:** this is the only form of function allowed in binding annotations.
{: .alert .alert-info }

Example:

    <dom-module id="x-custom">
      <template>
        My name is <span>{%raw%}{{computeFullName(first, last)}}{%endraw%}</span>
      </template>
    <dom-module id="x-custom">

    <script>
      Polymer({
        is: 'x-custom',
        properties: {
          first: String,
          last: String       
        },
        computeFullName: function(first, last) {
          return first + ' ' + last;
        }
        ...
      });
    </script>

In this case, the span's `textContent` property is bound to the return value 
of `computeFullName`, which is recalculated whenever `first` or `last` changes.

**Note:** The computed binding is not called until all dependent properties are defined 
(`!=undefined`). So each dependent properties should have a 
default `value` defined in `properties` (or otherwise be initialized to a 
non-`undefined` value) to ensure the function value is computed.
{: .alert .alert-info }

Arguments to computing functions may be simple properties on the current scope, as 
well as any of the arguments types supported by `observers`, including [paths](#path-observation), 
[paths with wildcards](#deep-observation), and [paths to array splices](#array-observation).  
The arguments received by the computing function match those described in the sections referenced above.

## Annotated attribute binding {#attribute-binding}

In the vast majority of cases, binding data to other elements should use
property binding described above, where changes are propagated by setting the
new value to the JavaScript property on the element.

However, sometimes you need to set an attribute on
an element, as opposed to a property.  These include when attribute selectors
are used for CSS or for for interoperability with elements that require using an
attribute-based API.

To bind to an attribute, use `$=` rather than `=`.  This
results in in a call to:

<code><var>element</var>.setAttribute(<var>attr</var>, <var>value</var>);</code>

As opposed to:

<var>element</var>.<var>property</var> = <var>value</var>;

    <template>
      {% raw %}
      <!-- Attribute binding -->
      <my-element selected$="{{value}}"></my-element>
      <!-- results in <my-element>.setAttribute('selected', this.value); -->

      <!-- Property binding -->
      <my-element selected="{{value}}"></my-element>
      <!-- results in <my-element>.selected = this.value; -->
      {% endraw %}
    </template>

Attribute bindings are always one-way, host-to-child. Values are serialized according to 
the value's _current_ type, as described for [attribute serialization](properties.html#attribute-serialization).

Again, as values must be serialized to strings when binding to attributes, it is
always more performant to use property binding for pure data propagation.

### Binding to native element attributes {#native-binding}

There are a handful of extremely common native element attributes which can also
be modified as properties.  Due to cross-browser limitations with the ability to
place binding braces {%raw%}`{{...}}`{%endraw%} in some of these attribute values, as well as the
fact that some of these attributes map to differently named JavaScript properties, it is
recommended to always use attribute binding (using `$=`) when binding dynamic
values to these specific attributes, rather than binding to their property
names.

Normal attribute assignment to static values:

    <!-- class -->
    <div class="foo"></div>

    <!-- style -->
    <div style="background: red;"></div>

    <!-- href -->
    <a href="http://foo.com">

    <!-- label for -->
    <label for="bar"></label>

    <!-- dataset -->
    <div data-bar="baz"></div>

Attribute binding to dynamic values (use `$=`):

    {% raw %}
    <!-- class -->
    <div class$="{{foo}}"></div>

    <!-- style -->
    <div style$="{{background}}"></div>

    <!-- href -->
    <a href$="{{url}}">

    <!-- label for -->
    <label for$="{{bar}}"></label>

    <!-- dataset -->
    <div data-bar$="{{baz}}"></div>
    {% endraw %}


