const el = wp.element.createElement;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.blockEditor;
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

const BLOCKS_TEMPLATE = [
	[ 'core/archives', {} ],
];

registerBlockType( 'learnpress/test', {
	title: 'Test',
	category: 'learnpress',
	description: __( 'sdfsdfsdfsdf', 'learnpress' ),
	edit: () => {
		const blockProps = useBlockProps( { style: { color: 'red' } } );

		return <p { ...blockProps }>{ __( 'Hello World', 'myguten' ) }</p>;
	},

	save: () => {
		const blockProps = useBlockProps.save( { style: { color: 'red' } } );

		return <p { ...blockProps }>{ __( 'Hello World', 'myguten' ) }</p>;
	},
} );
