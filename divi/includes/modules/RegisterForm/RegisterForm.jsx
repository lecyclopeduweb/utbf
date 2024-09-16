// External Dependencies
import React, { Component } from 'react';


class UtbfRegisterForm extends Component {

  static slug = 'UTBF_register_form';

  /**
   * Module render in VB
   * Basically UTBF_CTA_Parent->render() equivalent in JSX
   */
  render() {
    return (
      <div>
        <h2 className="utbf-title">{this.props.title}</h2>
        <div className="utbf-content">{this.props.content}</div>
      </div>
    );
  }
}

export default UtbfRegisterForm;
